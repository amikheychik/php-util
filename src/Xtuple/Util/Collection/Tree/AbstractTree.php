<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Tree;

abstract class AbstractTree
  implements Tree {
  /** @var Tree */
  private $tree;

  public function __construct(Tree $tree) {
    $this->tree = $tree;
  }

  public final function data(): array {
    return $this->tree->data();
  }

  public final function set(array $path, $value) {
    return $this->tree->set($path, $value);
  }

  public final function get(array $path) {
    return $this->tree->get($path);
  }

  public final function remove(array $path) {
    return $this->tree->remove($path);
  }

  public final function current() {
    return $this->tree->current();
  }

  public final function key() {
    return $this->tree->key();
  }

  public final function valid() {
    return $this->tree->valid();
  }

  public final function next() {
    $this->tree->next();
  }

  public final function rewind() {
    $this->tree->rewind();
  }

  public final function isEmpty(): bool {
    return $this->tree->isEmpty();
  }

  public final function count() {
    return $this->tree->count();
  }
}
