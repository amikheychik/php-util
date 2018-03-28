<?php declare(strict_types=1);

namespace Xtuple\Util\File\Directory;

use Xtuple\Util\Exception\Exception;

final class PackageDirectory
  extends AbstractDirectory {
  /**
   * @param string $namespace - must be __NAMESPACE__
   * @param string $directory - must be __DIR__
   *
   * @throws Exception
   */
  public function __construct(string $namespace, string $directory) {
    parent::__construct(new DirectoryPath(
      dirname(str_replace(str_replace('\\', '/', $namespace), '', $directory))
    ));
  }
}
