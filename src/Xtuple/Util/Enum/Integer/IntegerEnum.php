<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Integer;

use Xtuple\Util\Exception\Exception;

abstract class IntegerEnum {
  /** @var int */
  private $value;

  /**
   * @throws \Throwable
   *
   * @param int $value
   */
  public final function __construct(int $value) {
    if (!in_array($value, self::values(), true)) {
      throw new Exception('Value `{value}` is not supported in {class} enum', [
        'value' => $value,
        'class' => static::class,
      ]);
    }
    $this->value = $value;
  }

  public final function value(): int {
    return $this->value;
  }

  public final function is(int $value): bool {
    return $this->value === $value;
  }

  /** @var int[][] */
  private static $values;

  /**
   * @return int[][]
   */
  private static function values(): array {
    if (!isset(self::$values[static::class])) {
      /** @noinspection PhpUnhandledExceptionInspection - class exists as it's called through static */
      self::$values[static::class] = (new \ReflectionClass(static::class))->getConstants();
    }
    return self::$values[static::class];
  }
}
