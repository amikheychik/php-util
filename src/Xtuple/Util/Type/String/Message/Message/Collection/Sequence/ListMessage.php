<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Message\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\Sequence;
use Xtuple\Util\Type\String\Message\Message\Message;

interface ListMessage
  extends Sequence {
  /**
   * @param int $key
   *
   * @return Message|null
   */
  public function get(int $key);

  /**
   * @return Message|null
   */
  public function current();
}
