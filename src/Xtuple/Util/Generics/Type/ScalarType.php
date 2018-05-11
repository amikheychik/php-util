<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Generics\Type\Exception\ValueTypeException;

final class ScalarType
  implements Type {
  /**
   * @throws TypeThrowable
   *
   * @param string|float|int|bool $instance
   *
   * @return string|float|int|bool
   */
  public function cast($instance) {
    if (!is_scalar($instance)) {
      throw new ValueTypeException('scalar', gettype($instance));
    }
    return $instance;
  }
}
