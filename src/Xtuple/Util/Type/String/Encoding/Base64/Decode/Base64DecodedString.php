<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64\Decode;

final class Base64DecodedString
  implements Base64DecodedChars {
  /** @var string */
  private $decoded;

  public function __construct(string $decoded) {
    $this->decoded = $decoded;
  }

  public function __toString(): string {
    return $this->decoded;
  }
}
