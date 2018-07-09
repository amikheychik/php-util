<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

final class NullableScalarType
  implements Type {
  /** @var null|ScalarType */
  private $type;

  /**
   * @throws \Throwable
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
