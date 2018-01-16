<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path;

abstract class AbstractPath
  implements Path {
  /** @var Path */
  private $path;

  public function __construct(Path $path) {
    $this->path = $path;
  }

  public final function absolute(): ?string {
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
