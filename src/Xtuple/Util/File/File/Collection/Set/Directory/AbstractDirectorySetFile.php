<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set\Directory;

use Xtuple\Util\File\Directory\Directory;

abstract class AbstractDirectorySetFile
  implements DirectorySetFile {
  /** @var DirectorySetFile */
  private $files;

  public function __construct(DirectorySetFile $files) {
    $this->files = $files;
  }

  public final function get(string $path) {
    return $this->files->get($path);
  }

  public final function directory(): Directory {
    return $this->files->directory();
  }

  public final function isEmpty(): bool {
    return $this->files->isEmpty();
  }

  public final function current() {
    return $this->files->current();
  }

  public final function key() {
    return $this->files->key();
  }

  public final function next() {
    $this->files->next();
  }

  public final function valid() {
    return $this->files->valid();
  }

  public final function rewind() {
    $this->files->rewind();
  }

  public final function count() {
    return $this->files->count();
  }
}
