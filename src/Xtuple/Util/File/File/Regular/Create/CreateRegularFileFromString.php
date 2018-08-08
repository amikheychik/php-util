<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Regular\Create;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\File\File\Regular\AbstractRegular;
use Xtuple\Util\File\File\Regular\RegularFile;

final class CreateRegularFileFromString
  extends AbstractRegular {
  /**
   * @throws Throwable
   *
   * @param string $path
   * @param string $content
   */
  public function __construct(string $path, string $content) {
    try {
      new MakeDirectoryPath(dirname($path));
      $resource = fopen($path, 'wb');
      fwrite($resource, $content);
      fclose($resource);
      parent::__construct(new RegularFile(new FileFromPathString($path)));
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to create file {path}', [
        'path' => $path,
      ]);
    }
  }
}
