<?php
/** @noinspection PhpExpressionResultUnusedInspection */
/** @noinspection SuspiciousAssignmentsInspection */
/** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

use Xtuple\Util\Enum\Integer\IntegerEnum;

final class IntegerStatus
  extends IntegerEnum {
  // Only declared as constants values are allowed
  public const UNPUBLISHED = 0;
  public const DRAFT = 1;
  public const PUBLISHED = 2;

  // A shortcut static constructor for each value is recommended
  public static function UNPUBLISHED(): IntegerStatus {
    /** @noinspection PhpUnhandledExceptionInspection - verified value */
    return new self(self::UNPUBLISHED);
  }

  // A value check shortcut for each value is recommended
  public function isUnpublished(): bool {
    return $this->is(self::UNPUBLISHED);
  }
}

// These declarations would return the same value (but different objects)
/** @noinspection PhpUnhandledExceptionInspection - verified value */
$status = new IntegerStatus(Status::UNPUBLISHED);
/** @noinspection PhpUnhandledExceptionInspection - verified value */
$status = new IntegerStatus(0);
$status = IntegerStatus::UNPUBLISHED(); // if a shortcut method provided

// Check for the value
$status->value() === 0;
$status->is(IntegerStatus::UNPUBLISHED);
$status->isUnpublished();  // if a shortcut method provided

// Providing wrong value would cause an exception
try {
  // E.g. $row is loaded from a database
  $row = [
    'status' => 3,
  ];
  $status = new IntegerStatus($row['status']);
}
catch (\Throwable $e) {
  // Value `3` is not supported...
}
