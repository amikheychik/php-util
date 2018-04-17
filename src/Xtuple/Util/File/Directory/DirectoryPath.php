<?php declare(strict_types=1);

namespace Xtuple\Util\File\Directory;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\File\File\AbstractFile;
use Xtuple\Util\File\File\FileSplFileInfo;

final class DirectoryPath
  extends AbstractFile
  implements Directory {
  /**
   * @throws \Throwable
   *
   * @param string $path
   */
  public function __construct(string $path) {
    $directory = new \SplFileInfo($path);
    if (!$directory->isDir()) {
      throw new Exception('Path {path} is not a directory', [
        'path' => $path,
      ]);
    }
    parent::__construct(new FileSplFileInfo($directory));
  }
}
