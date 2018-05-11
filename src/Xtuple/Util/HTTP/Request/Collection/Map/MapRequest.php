<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Collection\Map;

use Xtuple\Util\Collection\Map\Map;
use Xtuple\Util\HTTP\Request\Request;

interface MapRequest
  extends Map {
  /**
   * @return null|Request
   *
   * @param string $key
   */
  public function get(string $key);

  /**
   * @return null|Request
   */
  public function current();
}
