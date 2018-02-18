<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Char;

abstract class StringEnum {
  /** @var string */
  private $value;

  /**
   * @throws \Throwable
   *
   * @param string $value
   */
  public function __construct(string $value) {
    if (!in_array($value, self::values(), true)) {
      throw new \InvalidArgumentException(strtr('Value `{value}` is not supported in {class} enum', [
        '{value}' => $value,
        '{class}' => static::class,
      ]));
    }
    $this->value = $value;
  }

  public final function value(): string {
    return $this->value;
  }

  public final function is(string $value): bool {
    return $this->value === $value;
  }

  /** @var string[][] */
  private static $values;

  /**
   * @throws \ReflectionException
   * @return array
   */
  private static function values(): array {
    if (!isset(self::$values[static::class])) {
      self::$values[static::class] = (new \ReflectionClass(static::class))->getConstants();
    }
    return self::$values[static::class];
  }
}
