<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set;

use Xtuple\Util\Collection\Collection;

interface Set
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
   * @return mixed|null
   *
   * @generic
   */
  public function current();

  /**
   * @return string|null
   */
  public function key();
}
