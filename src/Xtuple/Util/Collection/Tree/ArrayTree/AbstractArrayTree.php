<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Tree\ArrayTree;

use Xtuple\Util\Collection\Tree\Tree;

abstract class AbstractArrayTree
  implements Tree {
  /** @var array */
  private $data;

  public function __construct(array $data = []) {
    $this->data = $data;
  }

  public final function data(): array {
    return $this->data;
  }

  public final function set(array $path, $value) {
    $previous = $this->get($path);
    $data = &$this->data;
    foreach ($this->keys($path) as $key) {
      $data = &$data[$key];
      if (isset($data) && !is_array($data)) {
        $data = [];
      }
    }
    $data = $value;
    return $previous;
  }

  public final function get(array $path) {
    $data = &$this->data;
    foreach ($this->keys($path) as $key) {
      if (!is_array($data) || !isset($data[$key])) {
        return null;
      }
      $data = &$data[$key];
    }
    return $data;
  }

  public final function remove(array $path) {
    $previous = $this->get($path);
    $data = &$this->data;
    $path = $this->keys($path);
    $last = array_pop($path);
    foreach ($path as $key) {
      if (!is_array($data) || !isset($data[$key])) {
        return null;
      }
      $data = &$data[$key];
    }
    unset($data[$last]);
    return $previous;
  }

  public final function current() {
    return current($this->data);
  }

  public final function key() {
    return key($this->data);
  }

  public final function next() {
    next($this->data);
  }

  public final function valid() {
    return key($this->data) !== null;
  }

  public final function rewind() {
    reset($this->data);
  }

  public final function isEmpty(): bool {
    return empty($this->data);
  }

  public final function count() {
    return count($this->data);
  }

  private function keys(array $path): array {
    $keys = [];
    foreach ($path as $key) {
      $keys[] = is_int($key) ? $key : (string) $key;
    }
    return $keys;
  }
}
