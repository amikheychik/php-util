<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use Xtuple\Util\Collection\Set\Set;
use Xtuple\Util\HTTP\Message\Header\Header;

interface SetHeader
  extends Set {
  /**
   * @return null|Header
   *
   * @param string $name
   */
  public function get(string $name);

  /**
   * @return null|Header
   */
  public function current();
}
