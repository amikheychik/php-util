<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header;

use Xtuple\Util\Type\String\Chars;

interface Header
  extends Chars {
  public function name(): string;

  public function value(): string;
}
