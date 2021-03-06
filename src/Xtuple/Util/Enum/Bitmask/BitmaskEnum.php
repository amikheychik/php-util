<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Bitmask;

use Xtuple\Util\Exception\Exception;

abstract class BitmaskEnum {
  /** @var int */
  private $value;

  /**
   * @throws \Throwable
   *
   * @param int $value
   */
  public function __construct(int $value) {
    if ($value > self::max()) {
      throw new Exception('Value `{value}` is not supported in bitmask enum {class}', [
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

  public final function has(int $flag): bool {
    if ($flag) {
      return ($this->value & $flag) > 0;
    }
    return true;
  }

  /** @var int[] */
  private static $max;

  /**
   * @throws \Throwable
   *
   * @return int
   */
  private static function max(): int {
    if (!isset(self::$max[static::class])) {
      $bitmask = 0b0;
      /** @noinspection PhpUnhandledExceptionInspection - class exists as it's called through static */
      foreach ((new \ReflectionClass(static::class))->getConstants() as $constant => $mask) {
        $bitmask |= $mask;
      }
      $size = log($bitmask + 1, 2);
      $max = (int) (2 ** ceil($size) - 1);
      if (ceil($size) !== floor($size)) {
        throw new Exception('Bitmask {class} values do not form full {value} (0b{bin}) mask', [
          'class' => static::class,
          'value' => $max,
          'bin' => decbin($max),
        ]);
      }
      self::$max[static::class] = $max;
    }
    return self::$max[static::class];
  }
}
