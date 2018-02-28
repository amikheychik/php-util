<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Transliteration;

use Xtuple\Util\Type\String\Chars;

interface Transliteration
  extends Chars {
  public function original(): string;
}
