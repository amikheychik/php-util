<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set\Directory;

use Xtuple\Util\File\Directory\Directory;
use Xtuple\Util\File\File\Collection\Set\SetFile;

interface DirectorySetFile
  extends SetFile {
  public function directory(): Directory;
}
