<?php
/** @noinspection PhpExpressionResultUnusedInspection */
/** @noinspection SuspiciousAssignmentsInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

use Xtuple\Util\Enum\Char\OptionalStringEnum;

final class OptionalStatus
  extends OptionalStringEnum {
  // Only declared as constants values are allowed
  public const UNPUBLISHED = 'unpublished';
  public const PUBLISHED = 'published';

  // A shortcut static constructor for each value is recommended
  public static function UNDEFINED(): OptionalStatus {
    /** @noinspection PhpUnhandledExceptionInspection */
    return new self(null);
  }

  // A value check shortcut for each value is recommended
  public function isUndefined(): bool {
    return $this->is(null);
  }
}

// These declarations would return the same value (but different objects)
/** @noinspection PhpUnhandledExceptionInspection - null is allowed for optional */
$status = new OptionalStatus(null);
// If a shortcut method provided
$status = OptionalStatus::UNDEFINED();

// Check for the value
$status->value() === null;
$status->is(null);
// If a shortcut method provided
$status->isUndefined();
