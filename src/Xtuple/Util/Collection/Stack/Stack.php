<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Stack;

use Xtuple\Util\Collection\Collection;

interface Stack
  extends Collection {
  /**
   * @param mixed $element
   *
   * @return int
   *
   * @generic
   */
  public function push($element): int;

  /**
   * @return mixed|null
   *
   * @generic
   */
  public function pop();

  /**
   * @return int|null
   */
  public function key();
}
