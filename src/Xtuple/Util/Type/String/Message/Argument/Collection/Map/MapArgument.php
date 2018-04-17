<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument\Collection\Map;

use Xtuple\Util\Collection\Map\Map;
use Xtuple\Util\Type\String\Message\Argument\Argument;

interface MapArgument
  extends Map {
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
