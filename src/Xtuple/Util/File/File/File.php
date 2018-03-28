<?php declare(strict_types=1);

namespace Xtuple\Util\File\File;

use Xtuple\Util\File\Path\Path;

interface File {
  public function path(): Path;

  public function name(): string;

  public function modified(): int;
}
