<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path;

final class PathString
  implements Path {
  /** @var string */
  private $path;

  public function __construct(string $path) {
    $this->path = $path;
  }

  public function absolute(): ?string {
    return realpath($this->path) ?: null;
  }

  public function exists(): bool {
    return !is_null($this->absolute());
  }

  public function isDir(): bool {
    return $this->exists() ? is_dir($this->absolute()) : false;
  }

  public function isFile(): bool {
    return $this->exists() ? is_file($this->absolute()) : false;
  }
}
