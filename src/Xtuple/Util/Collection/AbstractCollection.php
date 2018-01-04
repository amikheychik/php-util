<?php declare(strict_types=1);

namespace Xtuple\Util\Collection;

abstract class AbstractCollection
  implements Collection {
  /** @var Collection */
  private $collection;

  public function __construct(Collection $collection) {
    $this->collection = $collection;
  }

  public final function isEmpty(): bool {
    return $this->collection->isEmpty();
  }

  public final function current() {
    return $this->collection->current();
  }

  public final function next() {
    $this->collection->next();
  }

  public final function key() {
    return $this->collection->key();
  }

  public final function valid() {
    return $this->collection->valid();
  }

  public final function rewind() {
    $this->collection->rewind();
  }

  public final function count() {
    return $this->collection->count();
  }
}
