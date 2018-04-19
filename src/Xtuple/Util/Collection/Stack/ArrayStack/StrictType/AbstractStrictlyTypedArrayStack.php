<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Stack\ArrayStack\StrictType;

use Xtuple\Util\Collection\Exception\ElementTypeException;
use Xtuple\Util\Collection\Stack\ArrayStack\ArrayStack;
use Xtuple\Util\Collection\Stack\Stack;
use Xtuple\Util\Generics\Type\StrictType;

abstract class AbstractStrictlyTypedArrayStack
  implements Stack {
  /** @var StrictType */
  private $type;
  /** @var ArrayStack */
  private $stack;

  /**
   * @throws \Throwable - if element is of the wrong type.
   *
   * @param string   $type
   * @param iterable $elements
   */
  public function __construct(string $type, iterable $elements = []) {
    $this->type = new StrictType($type);
    $index = [];
    foreach ($elements as $i => $element) {
      try {
        $index[] = $this->type->cast($element);
      }
      catch (\Throwable $e) {
        throw new ElementTypeException((string) $i, $this->type, $element, $e);
      }
    }
    $this->stack = new ArrayStack($index);
  }

  /**
   * @throws \Throwable
   *
   * @param mixed $element
   *
   * @return int
   */
  public final function push($element): int {
    return $this->stack->push($this->type->cast($element));
  }

  public final function pop() {
    return $this->stack->pop();
  }

  public final function isEmpty(): bool {
    return $this->stack->isEmpty();
  }

  public final function current() {
    return $this->stack->current();
  }

  public final function next() {
    $this->stack->next();
  }

  public final function valid() {
    return $this->stack->valid();
  }

  public final function rewind() {
    $this->stack->rewind();
  }

  public final function count() {
    return $this->stack->count();
  }

  public final function key() {
    return $this->stack->key();
  }
}
