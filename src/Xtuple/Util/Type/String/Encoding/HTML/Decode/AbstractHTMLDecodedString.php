<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Decode;

abstract class AbstractHTMLDecodedString
  implements HTMLDecodedChars {
  /** @var HTMLDecodedChars */
  private $decoded;

  public function __construct(HTMLDecodedChars $decoded) {
    $this->decoded = $decoded;
  }

  public final function __toString(): string {
    return $this->decoded->__toString();
  }

  public final function quotes(): int {
    return $this->decoded->quotes();
  }

  public final function charset(): string {
    return $this->decoded->charset();
  }
}
