<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Char;

use Xtuple\Util\Exception\Exception;

abstract class OptionalStringEnum {
  /** @var null|string */
  private $value;

  /**
   * @throws \Throwable
   *
   * @param string|null $value
   */
  public final function __construct(?string $value) {
    if ($value !== null
      && !in_array($value, self::values(), true)) {
      throw new Exception('Value `{value}` is not supported in {class} enum', [
        'value' => $value,
        'class' => static::class,
      ]);
    }
    $this->value = $value;
  }

  public final function value(): ?string {
    return $this->value;
  }

  public final function is(?string $value): bool {
    if ($value === null) {
      return $this->value === null;
    }
    return $this->value === $value;
  }

  /** @var string[][] */
  private static $values;

  /**
   * @return string[][]
   */
  private static function values(): array {
    if (!isset(self::$values[static::class])) {
      /** @noinspection PhpUnhandledExceptionInspection - class exists as it's called through static */
      self::$values[static::class] = (new \ReflectionClass(static::class))->getConstants();
    }
    return self::$values[static::class];
  }
}
