<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use Xtuple\Util\Generics\Type\Exception\ValueTypeException;

final class CastType
  implements Type {
  /** @var string */
  private $type;
  /** @var null|string */
  private $class;

  /**
   * @param mixed $element
   */
  public function __construct($element) {
    $this->type = gettype($element);
    if ($this->type === 'object') {
      $this->class = get_class($element);
    }
  }

  public function fqn(): string {
    if ($this->class !== null) {
      return (new StrictType($this->class))->fqn();
    }
    return $this->type;
  }

  public function cast($instance) {
    if ($this->class !== null) {
      return (new StrictType($this->class))->cast($instance);
    }
    if ($this->type !== gettype($instance)) {
      throw new ValueTypeException($this->type, gettype($instance));
    }
    return $instance;
  }
}
