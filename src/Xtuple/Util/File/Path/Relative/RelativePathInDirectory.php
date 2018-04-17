<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path\Relative;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\File\Directory\Directory;
use Xtuple\Util\File\File\File;

final class RelativePathInDirectory
  implements RelativePath {
  /** @var Directory */
  private $directory;
  /** @var File */
  private $file;

  /**
   * @throws \Throwable
   *
   * @param Directory $directory
   * @param File      $file
   */
  public function __construct(Directory $directory, File $file) {
    if (strpos($file->path()->absolute(), $directory->path()->absolute()) !== 0) {
      throw new Exception('File {file} is not located in directory {dir}', [
        'file' => $file->path()->absolute(),
        'dir' => $directory->path()->absolute(),
      ]);
    }
    $this->directory = $directory;
    $this->file = $file;
  }

  public function relative(): string {
    return strtr($this->file->path()->absolute(), [
      "{$this->directory->path()->absolute()}/" => '',
    ]);
  }

  public function absolute(): string {
    return $this->file->path()->absolute();
  }

  public function exists(): bool {
    return $this->file->path()->exists();
  }

  public function isDir(): bool {
    return $this->file->path()->isDir();
  }

  public function isFile(): bool {
    return $this->file->path()->isFile();
  }
}
