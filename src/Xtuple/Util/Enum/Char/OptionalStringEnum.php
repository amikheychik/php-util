<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Char;

abstract class OptionalStringEnum {
  /** @var null|string */
  private $value;

  /**
   * @throws \InvalidArgumentException
   *
   * @param string|null $value
   */
  public final function __construct(?string $value) {
    if (!is_null($value)) {
      if (!in_array($value, self::values(), true)) {
        throw new \InvalidArgumentException(strtr('Value `{value}` is not supported in {class} enum', [
          '{value}' => $value,
          '{class}' => static::class,
        ]));
      }
    }
    $this->value = $value;
  }

  public final function value(): ?string {
    return $this->value;
  }

  public final function is(?string $value): bool {
    if (is_null($value)) {
      return is_null($this->value);
    }
    return $this->value === $value;
  }

  /** @var string[][] */
  private static $values;

  private static function values(): array {
    if (!isset(self::$values[static::class])) {
      self::$values[static::class] = (new \ReflectionClass(static::class))->getConstants();
    }
    return self::$values[static::class];
  }
}
