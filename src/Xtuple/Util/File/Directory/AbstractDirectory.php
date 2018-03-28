<?php declare(strict_types=1);

namespace Xtuple\Util\File\Directory;

use Xtuple\Util\File\File\AbstractFile;

abstract class AbstractDirectory
  extends AbstractFile
  implements Directory {
  public function __construct(Directory $directory) {
    parent::__construct($directory);
  }
}
