<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set;

use Xtuple\Util\Collection\Set\Set;
use Xtuple\Util\File\File\File;

interface SetFile
  extends Set {
  /**
   * @return File|null
   *
   * @param string $path
   */
  public function get(string $path);

  /**
   * @return File|null
   */
  public function current();

  /**
   * @return string|null - filepath
   */
  public function key();
}
