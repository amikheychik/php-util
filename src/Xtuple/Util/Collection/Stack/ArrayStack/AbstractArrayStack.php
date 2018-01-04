<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Stack\ArrayStack;

use Xtuple\Util\Collection\Stack\Stack;

abstract class AbstractArrayStack
  implements Stack {
  /** @var array */
  private $elements;

  public function __construct(array $elements = []) {
    $this->elements = array_values($elements);
  }

  public final function push($element): int {
    return array_push($this->elements, $element);
  }

  public final function pop() {
    return array_pop($this->elements);
  }

  public final function isEmpty(): bool {
    return empty($this->elements);
  }

  public final function current() {
    return current($this->elements) ?: null;
  }

  public final function next() {
    next($this->elements);
  }

  public final function key() {
    return key($this->elements);
  }

  public final function valid() {
    return !is_null(key($this->elements));
  }

  public final function rewind() {
    reset($this->elements);
  }

  public final function count() {
    return sizeof($this->elements);
  }
}
