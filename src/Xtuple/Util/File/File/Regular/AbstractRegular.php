<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Regular;

use Xtuple\Util\File\File\AbstractFile;

abstract class AbstractRegular
  extends AbstractFile
  implements Regular {
  /** @var Regular */
  private $file;

  public function __construct(Regular $file) {
    parent::__construct($file);
    $this->file = $file;
  }

  public final function content(): string {
    return $this->file->content();
  }
}
