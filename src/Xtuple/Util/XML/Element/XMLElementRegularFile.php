<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\File\File\Regular\Regular;

final class XMLElementRegularFile
  extends AbstractXMLElement {
  /**
   * @throws \Throwable
   *
   * @param Regular $file
   */
  public function __construct(Regular $file) {
    try {
      parent::__construct(new XMLElementString($file->content()));
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to load XML from file {file} content', [
        'file' => $file->path()->absolute(),
      ]);
    }
  }
}
