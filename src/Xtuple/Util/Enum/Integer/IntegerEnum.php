<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Integer;

abstract class IntegerEnum {
  /** @var int */
  private $value;

  /**
   * @throws \InvalidArgumentException
   *
   * @param int $value
   */
  public final function __construct(int $value) {
    if (!in_array($value, self::values(), true)) {
      throw new \InvalidArgumentException(strtr('Value `{value}` is not supported in {class} enum', [
        '{value}' => $value,
        '{class}' => static::class,
      ]));
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

  private static function values(): array {
    if (!isset(self::$values[static::class])) {
      self::$values[static::class] = (new \ReflectionClass(static::class))->getConstants();
    }
    return self::$values[static::class];
  }
}
