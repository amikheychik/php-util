<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Encode;

use Xtuple\Util\Type\String\Chars;

interface HTMLEncodedChars
  extends Chars {
  public function quotes(): int;

  public function charset(): string;
}
