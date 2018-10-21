<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\DateTime\DateTimeString;
use Xtuple\Util\Type\DateTime\DateTimeStruct;
use Xtuple\Util\Type\DateTime\DateTimeTimestamp;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampDateTime;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

// DateTime information depends on the timezone.
// Examples are shown for a specific timezone.
$default = ini_get('date.timezone');
ini_set('date.timezone', 'America/New_York');

// \DateTimeImmutable is used as to handle datetime information.
// By default server timezone is used.
/** @noinspection PhpUnhandledExceptionInspection - date is correct */
$date = new DateTimeStruct(new \DateTimeImmutable('Jan 1, 2018'));
// Jan 1, 2018 5am UTC
$date->__toString() === '2018-01-01T05:00:00+00:00';
$date->utc() === '2018-01-01T05:00:00Z';
json_encode($date) === '"2018-01-01T05:00:00.000Z"';

// Timezone information parsed from the date string precedes explicit timezone
/** @noinspection PhpUnhandledExceptionInspection - date is correct */
$date = new DateTimeStruct(
  new \DateTimeImmutable('Jan 1, 2018 PST', new \DateTimeZone('UTC'))
);
// Jan 1, 2018 8am UTC
$date->utc() === '2018-01-01T08:00:00Z';

// DateTimeString is a shortcut for DateTimeStruct
/** @noinspection PhpUnhandledExceptionInspection - date is correct */
$date = new DateTimeString('Jan 1, 2018', 'UTC');
(string) $date === '2018-01-01T00:00:00+00:00';

// DateTimeTimestamp is a shortcut to get DateTime from a timestamp.
// Unix timestamp is counted from UTC, so custom timezone can not be specified.
/** @noinspection PhpUnhandledExceptionInspection - timestamp is correct */
$date = new DateTimeTimestamp(new TimestampStruct(0));
(string) $date === '1970-01-01T00:00:00+00:00';

try {
  // Timestamp must be non-negative
  $date = new DateTimeTimestamp(new TimestampStruct(-1));
}
catch (\Throwable $e) {
  $e->getMessage() === 'Unix timestamp must be non-negative.';
}

/** @noinspection PhpUnhandledExceptionInspection - timestamp is correct */
$timestamp = new TimestampStruct(0);
$timestamp->seconds() === 0;

$timestamp = new TimestampDateTime(new DateTimeTimestamp($timestamp));
$timestamp->seconds() === 0;

try {
  // Timestamp must be non-negative
  $date = new TimestampStruct(-1);
}
catch (\Throwable $e) {
  $e->getMessage() === 'Unix timestamp must be non-negative.';
}

ini_set('date.timezone', $default);
