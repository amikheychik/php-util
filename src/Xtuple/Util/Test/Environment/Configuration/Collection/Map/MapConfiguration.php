<?php declare(strict_types=1);

namespace Xtuple\Util\Test\Environment\Configuration\Collection\Map;

use Xtuple\Util\Collection\Map\Map;
use Xtuple\Util\Test\Environment\Configuration\Configuration;

interface MapConfiguration
  extends Map {
  /**
   * @param string $type
   *
   * @return null|Configuration
   */
  public function get(string $type);

  /**
   * @return null|Configuration
   */
  public function current();
}
