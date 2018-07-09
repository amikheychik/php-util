<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set\Directory;

use Xtuple\Util\File\Directory\Directory;
use Xtuple\Util\File\File\File;

abstract class AbstractDirectoryIteratorSetFile
  implements DirectorySetFile {
  /** @var Directory */
  private $directory;
  /** @var \Iterator */
  private $files;

  public function __construct(Directory $directory, \Iterator $files) {
    $this->directory = $directory;
    $this->files = $files;
  }

  public final function directory(): Directory {
    return $this->directory;
  }

  public final function isEmpty(): bool {
    return $this->count() === 0;
  }

  public function get(string $path) {
    foreach ($this as $filepath => $file) {
      if ($path === $filepath) {
        return $file;
      }
    }
    return null;
  }

  public final function current() {
    while ($this->files->valid()) {
      try {
        return $this->file($this->files->current());
      }
      catch (\Throwable $e) {
      }
      $this->files->next();
    }
    return null;
  }

  /**
   * @throws \Throwable
   *
   * @param mixed $current
   *
   * @return File
   *
   * @generic
   */
  protected abstract function file($current): File;

  public final function key() {
    return $this->files->key();
  }

  public final function next() {
    $this->files->next();
  }

  public final function valid() {
    return $this->current() !== null;
  }

  public final function rewind() {
    $this->files->rewind();
  }

  public final function count() {
    $count = 0;
    $this->files->rewind();
    while ($this->valid()) {
      $count++;
      $this->next();
    }
    return $count;
  }
}
