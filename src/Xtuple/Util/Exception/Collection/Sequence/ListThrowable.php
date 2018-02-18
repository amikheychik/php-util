<?php declare(strict_types=1);

namespace Xtuple\Util\Exception\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\Sequence;

interface ListThrowable
  extends Sequence {
  /**
   * @return \Throwable|null
   *
   * @param int $key
   */
  public function get(int $key);

  /**
   * @return \Throwable|null
   */
  public function current();
}
