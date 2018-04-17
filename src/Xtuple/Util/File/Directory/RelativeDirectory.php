<?php declare(strict_types=1);

namespace Xtuple\Util\File\Directory;

final class RelativeDirectory
  extends AbstractDirectory {
  /**
   * @throws \Throwable
   *
   * @param Directory $directory
   * @param string    $relative
   */
  public function __construct(Directory $directory, string $relative) {
    parent::__construct(new DirectoryPath("{$directory->path()->absolute()}/$relative"));
  }
}
