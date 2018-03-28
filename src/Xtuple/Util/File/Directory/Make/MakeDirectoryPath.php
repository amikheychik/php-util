<?php declare(strict_types=1);

namespace Xtuple\Util\File\Directory\Make;

use Xtuple\Util\Exception\LastErrorException;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\File\Directory\AbstractDirectory;
use Xtuple\Util\File\Directory\DirectoryPath;

final class MakeDirectoryPath
  extends AbstractDirectory {
  /**
   * @throws Throwable
   *
   * @param string $path
   * @param int    $mode
   */
  public function __construct(string $path, int $mode = 0777) {
    if (!is_dir($path) && !mkdir($path, $mode, true)) {
      throw new LastErrorException('Failed to create a directory {dir}', [
        'dir' => $path,
      ]);
    }
    parent::__construct(new DirectoryPath($path));
  }
}
