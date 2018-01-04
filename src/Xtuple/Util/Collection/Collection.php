<?php declare(strict_types=1);

namespace Xtuple\Util\Collection;

interface Collection
  extends \Iterator, \Countable {
  public function isEmpty(): bool;

  /**
   * @return mixed|null
   *
   * @generic
   */
  public function current();

  /**
   * @return void
   */
  public function next();

  /**
   * @return bool
   */
  public function valid();

  /**
   * @return void
   */
  public function rewind();

  /**
   * @return int
   */
  public function count();
}
