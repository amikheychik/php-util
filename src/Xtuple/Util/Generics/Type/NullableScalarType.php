<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;

final class NullableScalarType
  implements Type {
  /** @var null|ScalarType */
  private $type;

  /**
   * @throws TypeThrowable
   *
   * @param string|float|int|bool|null $instance
   *
   * @return string|float|int|bool|null
   */
  public function cast($instance) {
    if ($instance === null) {
      return null;
    }
    if ($this->type === null) {
      $this->type = new ScalarType();
    }
    return $this->type->cast($instance);
  }
}
