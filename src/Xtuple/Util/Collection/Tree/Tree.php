<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Tree;

use Xtuple\Util\Collection\Collection;

interface Tree
  extends Collection {
  public function data(): array;

  /**
   * @return mixed - previous value
   *
   * @param array $path
   * @param mixed $value
   *
   * @generic
   */
  public function set(array $path, $value);

  /**
   * @return mixed|null
   *
   * @param array $path
   *
   * @generic
   */
  public function get(array $path);

  /**
   * @return mixed - last value
   *
   * @param array $path
   *
   * @generic
   */
  public function remove(array $path);

  /**
   * @return mixed|null
   *
   * @generic
   */
  public function current();

  /**
   * @return string|int|null
   */
  public function key();
}
