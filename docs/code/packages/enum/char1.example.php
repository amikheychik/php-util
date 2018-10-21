<?php
/** @noinspection PhpExpressionResultUnusedInspection */
/** @noinspection SuspiciousAssignmentsInspection */
/** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

use Xtuple\Util\Enum\Char\StringEnum;

final class Status
  extends StringEnum {
  // Only declared as constants values are allowed
  public const UNPUBLISHED = 'unpublished';
  public const DRAFT = 'draft';
  public const PUBLISHED = 'published';

  // A shortcut static constructor for each value is recommended
  public static function UNPUBLISHED(): Status {
    /** @noinspection PhpUnhandledExceptionInspection */
    return new self(self::UNPUBLISHED);
  }

  // A value check shortcut for each value is recommended
  public function isUnpublished(): bool {
    return $this->is(self::UNPUBLISHED);
  }
}

// These declarations would return the same value (but different objects)
/** @noinspection PhpUnhandledExceptionInspection */
$status = new Status(Status::UNPUBLISHED);
/** @noinspection PhpUnhandledExceptionInspection */
$status = new Status('unpublished');
// If a shortcut method provided
$status = Status::UNPUBLISHED();

// Check for the value
$status->value() === 'unpublished';
$status->is(Status::UNPUBLISHED);
// If a shortcut method provided
$status->isUnpublished();

// Providing wrong value would cause an exception
try {
  // E.g. $row is loaded from a database
  $row = [
    'status' => 'review',
  ];
  $status = new Status($row['status']);
}
catch (\Throwable $e) {
  // Value `review` is not supported
}
