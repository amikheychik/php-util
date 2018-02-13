<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

final class NullableScalarType
  implements Type {
  /** @var null|ScalarType */
  private $type;

  /**
   * @throws \InvalidArgumentException
   *
   * @param string|float|int|bool|null $instance
   *
   * @return string|float|int|bool|null
   */
  public function cast($instance) {
    if (is_null($instance)) {
      return null;
    }
    if (is_null($this->type)) {
      $this->type = new ScalarType();
    }
    return $this->type->cast($instance);
  }
}
