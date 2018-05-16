<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Encode;

use Xtuple\Util\Type\String\Chars;

final class EncodedHTMLTagsString
  implements Chars {
  /** @var string */
  private $string;

  public function __construct(string $string) {
    $this->string = $string;
  }

  public function __toString(): string {
    return str_replace('&#38;', '&amp;', htmlentities($this->string, ENT_NOQUOTES));
  }
}
