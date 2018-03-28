<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path;

final class PathString
  implements Path {
  /** @var string */
  private $path;

  public function __construct(string $path) {
    $this->path = $path;
  }

  public function absolute(): string {
    if ($path = realpath($this->path)) {
      return $path;
    }
    throw new \InvalidArgumentException(strtr('Path {path} does not exist', [
      '{path}' => $this->path,
    ]));
  }

  public function exists(): bool {
    if (realpath($this->path)) {
      return true;
    }
    return false;
  }

  public function isDir(): bool {
    return $this->exists()
      ? is_dir($this->absolute())
      : false;
  }

  public function isFile(): bool {
    return $this->exists()
      ? is_file($this->absolute())
      : false;
  }
}
