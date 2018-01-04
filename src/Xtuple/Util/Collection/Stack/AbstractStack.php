<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Stack;

abstract class AbstractStack
  implements Stack {
  /** @var Stack */
  private $stack;

  public function __construct(Stack $stack) {
    $this->stack = $stack;
  }

  public final function push($element): int {
    return $this->stack->push($element);
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
