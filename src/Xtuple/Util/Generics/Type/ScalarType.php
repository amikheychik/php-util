<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

final class ScalarType
  implements Type {
  /**
   * @throws \InvalidArgumentException
   *
   * @param string|float|int|bool $instance
   *
   * @return string|float|int|bool
   */
  public function cast($instance) {
    if (!is_scalar($instance)) {
      throw new \InvalidArgumentException(strtr('{type} is passed, scalar is required', [
        '{type}' => gettype($instance),
      ]));
    }
    return $instance;
  }
}
