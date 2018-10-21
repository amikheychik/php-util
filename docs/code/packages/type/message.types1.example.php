<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\DateTime\DateTimeString;
use Xtuple\Util\Type\String\Message\Type\Date\DateTimeMessageStruct;

$default = ini_get('date.timezone');
ini_set('date.timezone', 'America/New_York');

// DateTime is in UTC, formatter uses system default date.timezone setting
/** @noinspection PhpUnhandledExceptionInspection - verified date format */
$date = new DateTimeMessageStruct(
  new DateTimeString('2018-01-01T00:00:00Z'),
  'm/d/Y g:ia'
);

// Default output is in UTC
(string) $date === '01/01/2018 12:00am';

// Default server timezone is used
$date->timezone() === '12/31/2017 7:00pm';
// Custom timezone is used
$date->timezone('America/Los_Angeles') === '12/31/2017 4:00pm';

ini_set('date.timezone', $default);
