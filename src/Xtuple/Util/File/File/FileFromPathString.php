<?php declare(strict_types=1);

namespace Xtuple\Util\File\File;

use Xtuple\Util\Exception\ChainException;

final class FileFromPathString
  extends AbstractFile {
  /**
   * @throws \Throwable
   *
   * @param string $path
   */
  public function __construct(string $path) {
    try {
      parent::__construct(new FileSplFileInfo(
        new \SplFileInfo($path)
      ));
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to load file {path}', [
        'path' => $path,
      ]);
    }
  }
}
