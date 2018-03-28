<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set\Directory;

use Xtuple\Util\File\Directory\Directory;
use Xtuple\Util\File\File\File;
use Xtuple\Util\File\File\FileSplFileInfo;

final class RecursiveDirectorySetFile
  extends AbstractDirectoryIteratorSetFile {
  public function __construct(Directory $directory) {
    parent::__construct(
      $directory,
      new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator(
          $directory->path()->absolute(),
          \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::SKIP_DOTS
        )
      )
    );
  }

  /**
   * @param \SplFileInfo $current
   * {@inheritdoc}
   */
  protected function file($current): File {
    return new FileSplFileInfo($current);
  }
}
