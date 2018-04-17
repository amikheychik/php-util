<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Char;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Type\String\Chars;

abstract class StringEnum
  implements Chars {
  /** @var string */
  private $value;

  /**
   * @throws \Throwable
   *
   * @param string $value
   */
  public function __construct(string $value) {
    if (!in_array($value, self::values(), true)) {
      throw new Exception('Value `{value}` is not supported in {class} enum', [
        'value' => $value,
        'class' => static::class,
      ]);
    }
    $this->value = $value;
  }

  public function __toString(): string {
    return $this->value;
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
