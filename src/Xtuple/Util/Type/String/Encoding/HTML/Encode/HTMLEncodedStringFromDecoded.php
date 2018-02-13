<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Encode;

use Xtuple\Util\Type\String\Encoding\HTML\Decode\HTMLDecodedChars;

final class HTMLEncodedStringFromDecoded
  implements HTMLEncodedChars {
  /** @var HTMLDecodedChars */
  private $decoded;

  public function __construct(HTMLDecodedChars $decoded) {
    $this->decoded = $decoded;
  }

  public function quotes(): int {
    return $this->decoded->quotes();
  }

  public function charset(): string {
    return $this->decoded->charset();
  }

  public function __toString(): string {
    return htmlentities(
      (string) $this->decoded,
      $this->decoded->quotes(),
      $this->decoded->charset()
    );
  }
}
