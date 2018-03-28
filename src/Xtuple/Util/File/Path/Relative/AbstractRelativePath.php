<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path\Relative;

abstract class AbstractRelativePath
  implements RelativePath {
  /** @var RelativePath */
  private $path;

  public function __construct(RelativePath $path) {
    $this->path = $path;
  }

  public final function relative(): string {
    return $this->path->relative();
  }

  public final function absolute(): string {
    return $this->path->absolute();
  }

  public final function exists(): bool {
    return $this->path->exists();
  }

  public final function isDir(): bool {
    return $this->path->isDir();
  }

  public final function isFile(): bool {
    return $this->path->isFile();
  }
}
