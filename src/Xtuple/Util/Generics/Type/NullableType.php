<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

final class NullableType
  implements Type {
  /** @var StrictType */
  private $type;

  public function __construct(string $fqn) {
    $this->type = new StrictType($fqn);
  }

  public function cast($instance) {
    if (is_null($instance)) {
      return $instance;
    }
    return $this->type->cast($instance);
  }
}
