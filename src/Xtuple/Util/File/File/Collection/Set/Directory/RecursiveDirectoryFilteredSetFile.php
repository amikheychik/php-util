<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set\Directory;

use Xtuple\Util\File\Directory\Directory;
use Xtuple\Util\File\File\File;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\RegEx\RegEx;

final class RecursiveDirectoryFilteredSetFile
  extends AbstractDirectoryIteratorSetFile {
  public function __construct(Directory $directory, RegEx $filter) {
    parent::__construct(
      $directory,
      new \RegexIterator(
        new \RecursiveIteratorIterator(
          new \RecursiveDirectoryIterator(
            $directory->path()->absolute(),
            \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::SKIP_DOTS
          )
        ),
        $filter->pattern(),
        \RecursiveRegexIterator::GET_MATCH
      )
    );
  }

  /**
   * @param array $current
   * {@inheritdoc}
   */
  protected function file($current): File {
    return new FileFromPathString($current[0]);
  }
}
