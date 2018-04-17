<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Regular;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Exception\LastErrorException;
use Xtuple\Util\File\File\AbstractFile;
use Xtuple\Util\File\File\File;

final class RegularFile
  extends AbstractFile
  implements Regular {
  /**
   * @throws \Throwable
   *
   * @param File $file
   */
  public function __construct(File $file) {
    if (!$file->path()->isFile()) {
      throw new Exception('File {file} is not a regular file', [
        'file' => $file->path()->absolute(),
      ]);
    }
    parent::__construct($file);
  }

  /**
   * @throws \Throwable
   *
   * @return string
   */
  public function content(): string {
    try {
      $content = file_get_contents($this->path()->absolute());
      if ($content === false) {
        // @codeCoverageIgnoreStart
        // Unable to reproduce it for a local file
        throw new LastErrorException('Failed to get file {file} content', [
          'file' => $this->path()->absolute(),
        ]);
        // @codeCoverageIgnoreEnd
      }
      return $content;
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to read file {filename} content', [
        'filename' => $this->path()->absolute(),
      ]);
    }
  }
}
