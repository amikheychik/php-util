<?php declare(strict_types=1);

namespace Xtuple\Util\File\File;

use Xtuple\Util\File\Path\Path;

abstract class AbstractFile
  implements File {
  /** @var File */
  private $file;

  public function __construct(File $file) {
    $this->file = $file;
  }

  public final function path(): Path {
    return $this->file->path();
  }

  public final function name(): string {
    return $this->file->name();
  }

  public final function modified(): int {
    return $this->file->modified();
  }
}
