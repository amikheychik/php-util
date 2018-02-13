<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Decode;

use Xtuple\Util\Type\String\Chars;

interface HTMLDecodedChars
  extends Chars {
  public function quotes(): int;

  public function charset(): string;
}
