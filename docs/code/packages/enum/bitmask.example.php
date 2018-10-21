<?php
/** @noinspection PhpExpressionResultUnusedInspection */
/** @noinspection SuspiciousAssignmentsInspection */
/** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

use Xtuple\Util\Enum\Bitmask\BitmaskEnum;

final class Access
  extends BitmaskEnum {
  // Combination as the flags must allow to have all flags up
  // (e.g. 0b111 in this example)
  public const READ = 0b001;
  public const WRITE = 0b010;
  public const EXECUTE = 0b100;

  // A shortcut static constructor for each custom value is possible
  public static function DEFAULT(): Access {
    /** @noinspection PhpUnhandledExceptionInspection */
    return new self(self::READ | self::WRITE);
  }

  // A value check shortcut for each basic or custom value is possible
  public function isDefault(): bool {
    return $this->is(self::READ | self::WRITE);
  }
}

// Different declarations are possible
/** @noinspection PhpUnhandledExceptionInspection */
$access = new Access(Access::READ | Access::WRITE);
/** @noinspection PhpUnhandledExceptionInspection */
$access = new Access(3);
// If a shortcut method provided
$access = Access::DEFAULT();

// Different value checks are possible
/** @noinspection PhpExpressionResultUnusedInspection */
$access->value() === Access::READ | Access::WRITE;
$access->is(3);
$access->isDefault();

// Specific flag check
$access->has(Access::READ) === true;
$access->has(Access::EXECUTE) === false;
