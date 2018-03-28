<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Regular;

use Xtuple\Util\File\File\File;

interface Regular
  extends File {
  public function content(): string;
}
