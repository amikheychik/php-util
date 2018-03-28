<?php declare(strict_types=1);

namespace Xtuple\Util\File\File;

use Xtuple\Util\Exception\Exception;

final class FileFromPathString
  extends AbstractFile {
  /**
   * @throws Exception
   *
   * @param string $path
   */
  public function __construct(string $path) {
    parent::__construct(new FileSplFileInfo(
      new \SplFileInfo($path)
    ));
  }
}
