<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\Type\String\Chars;

interface StringBody
  extends Body,
          Chars {
  /**
   * @throws Throwable
   * @return string
   */
  public function content(): string;
}
