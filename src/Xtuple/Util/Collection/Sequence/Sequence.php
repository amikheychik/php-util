<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence;

use Xtuple\Util\Collection\Collection;

interface Sequence
  extends Collection {
  /**
   * @return mixed|null
   *
   * @param int $key
   *
   * @generic
   */
  public function get(int $key);

  /**
   * @return mixed|null
   *
   * @generic
   */
  public function current();

  /**
   * @return int|null
   */
  public function key();
}
