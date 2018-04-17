<?php declare(strict_types=1);

namespace Xtuple\Util\File\File;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Exception;
use Xtuple\Util\File\Path\Path;
use Xtuple\Util\File\Path\PathString;

final class FileSplFileInfo
  implements File {
  /** @var \SplFileInfo */
  private $file;

  /**
   * @throws \Throwable
   *
   * @param \SplFileInfo $file
   */
  public function __construct(\SplFileInfo $file) {
    try {
      if ($file->getRealPath() === false) {
        throw new Exception('File {file} not found', [
          'file' => $file->getPathname(),
        ]);
      }
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to load file {path}', [
        'path' => $file->getPathname(),
      ]);
    }
    $this->file = $file;
  }

  public function name(): string {
    return $this->file->getBasename();
  }

  public function path(): Path {
    return new PathString($this->file->getRealPath());
  }

  public function modified(): int {
    return $this->file->getMTime();
  }
}
