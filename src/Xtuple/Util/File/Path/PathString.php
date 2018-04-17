<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path;

use Xtuple\Util\Exception\Exception;

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
    throw new Exception('Path {path} does not exist', [
      'path' => $this->path,
    ]);
  }

  public function exists(): bool {
    if (realpath($this->path)) {
      return true;
    }
    return false;
  }

  public function isDir(): bool {
    /** @noinspection PhpUnhandledExceptionInspection - path existence is checked */
    return $this->exists()
      ? is_dir($this->absolute())
      : false;
  }

  public function isFile(): bool {
    /** @noinspection PhpUnhandledExceptionInspection - path existence is checked */
    return $this->exists()
      ? is_file($this->absolute())
      : false;
  }
}
