<?php declare(strict_types=1);

namespace Xtuple\Util\Collection;

abstract class AbstractArrayCollection
  implements Collection {
  /** @var array */
  private $elements;

  public function __construct(array $elements = []) {
    $this->elements = $elements;
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
    return key($this->elements) !== null;
  }

  public final function rewind() {
    reset($this->elements);
  }

  public final function count() {
    return count($this->elements);
  }
}
