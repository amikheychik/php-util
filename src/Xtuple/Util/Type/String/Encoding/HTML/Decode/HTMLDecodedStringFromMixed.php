<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Decode;

use Xtuple\Util\Type\String\Encoding\HTML\Encode\HTMLEncodedString;

final class HTMLDecodedStringFromMixed
  extends AbstractHTMLDecodedString {
  public function __construct($encoded, int $quotes = ENT_COMPAT | ENT_HTML401, ?string $charset = null) {
    parent::__construct(new HTMLDecodedStringFromEncoded(
      new HTMLEncodedString((string) $encoded, $quotes, $charset)
    ));
  }
}
