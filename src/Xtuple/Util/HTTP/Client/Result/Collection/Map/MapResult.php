<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Result\Collection\Map;

use Xtuple\Util\Collection\Map\Map;
use Xtuple\Util\HTTP\Client\Result\Result;

interface MapResult
  extends Map {
  /**
   * @param string $key
   *
   * @return null|Result
   */
  public function get(string $key);

  /**
   * @return null|Result
   */
  public function current();
}
