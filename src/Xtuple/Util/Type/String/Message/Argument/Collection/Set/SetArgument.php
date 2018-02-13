<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument\Collection\Set;

use Xtuple\Util\Collection\Set\Set;
use Xtuple\Util\Type\String\Message\Argument\Argument;

interface SetArgument
  extends Set {
  /**
   * @param string $key
   *
   * @return Argument|null
   */
  public function get(string $key);

  /**
   * @return Argument|null
   */
  public function current();
}
