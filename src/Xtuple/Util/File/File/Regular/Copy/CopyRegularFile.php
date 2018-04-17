<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Regular\Copy;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\LastErrorException;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\File\File\Regular\AbstractRegular;
use Xtuple\Util\File\File\Regular\Regular;
use Xtuple\Util\File\File\Regular\RegularFile;

final class CopyRegularFile
  extends AbstractRegular {
  /**
   * @throws \Throwable
   *
   * @param Regular $original
   * @param string  $destination
   */
  public function __construct(Regular $original, string $destination) {
    try {
      new MakeDirectoryPath(dirname($destination));
      if (!copy($original->path()->absolute(), $destination)) {
        throw new LastErrorException('Failed to copy a file {from} to {to}', [
          'from' => $original->path()->absolute(),
          'to' => $destination,
        ]);
      }
      parent::__construct(new RegularFile(
        new FileFromPathString($destination)
      ));
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'File {original} copy to {destination} failed', [
        'original' => $original->path()->absolute(),
        'destination' => $destination,
      ]);
    }
  }
}
