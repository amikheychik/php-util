<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path\Relative;

use Xtuple\Util\File\Path\Path;

interface RelativePath
  extends Path {
  /**
   * @throws \Throwable
   * @return string
   */
  public function relative(): string;
}
