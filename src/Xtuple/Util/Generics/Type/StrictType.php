<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use Xtuple\Util\Generics\Type\Exception\ValueTypeException;

final class StrictType
  implements Type {
  /** @var string */
  private $fqn;

  public function __construct(string $fqn) {
    $this->fqn = ltrim($fqn, '\\');
  }

  public function fqn(): string {
    return $this->fqn;
  }

  public function cast($instance) {
    if (!is_object($instance)) {
      throw new ValueTypeException($this->fqn, gettype($instance));
    }
    if (!($instance instanceof $this->fqn)) {
      throw new ValueTypeException($this->fqn, get_class($instance));
    }
    return $instance;
  }
}
