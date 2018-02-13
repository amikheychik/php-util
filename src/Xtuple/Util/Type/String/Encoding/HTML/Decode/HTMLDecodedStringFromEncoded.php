<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Decode;

use Xtuple\Util\Type\String\Encoding\HTML\Encode\HTMLEncodedChars;

final class HTMLDecodedStringFromEncoded
  implements HTMLDecodedChars {
  /** @var HTMLEncodedChars */
  private $encoded;

  public function __construct(HTMLEncodedChars $encoded) {
    $this->encoded = $encoded;
  }

  public function quotes(): int {
    return $this->encoded->quotes();
  }

  public function charset(): string {
    return $this->encoded->charset();
  }

  public function __toString(): string {
    return html_entity_decode(
      (string) $this->encoded,
      $this->encoded->quotes(),
      $this->encoded->charset()
    );
  }
}
