<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream\String;

use Xtuple\Util\Type\Stream\Exception\Throwable;
use Xtuple\Util\Type\Stream\Stream;
use Xtuple\Util\Type\String\Chars;

interface StringStream
  extends Stream,
          Chars {
  /**
   * @throws Throwable
   * @return string
   */
  public function content(): string;
}
