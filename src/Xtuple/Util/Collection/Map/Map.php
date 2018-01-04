<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Map;

use Xtuple\Util\Collection\Collection;

interface Map
  extends Collection {
  /**
   * @return mixed|null
   *
   * @param string $key
   *
   * @generic
   */
  public function get(string $key);

  /**
   * @return string|null
   */
  public function key();
}
