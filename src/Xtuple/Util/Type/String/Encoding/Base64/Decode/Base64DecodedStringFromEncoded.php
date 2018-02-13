<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64\Decode;

use Xtuple\Util\Type\String\Encoding\Base64\Encode\Base64EncodedChars;

final class Base64DecodedStringFromEncoded
  implements Base64DecodedChars {
  /** @var Base64EncodedChars */
  private $encoded;

  public function __construct(Base64EncodedChars $encoded) {
    $this->encoded = $encoded;
  }

  public function __toString(): string {
    $decoded = base64_decode((string) $this->encoded, true);
    if ($decoded === false) {
      throw new \InvalidArgumentException('The input contains character from outside of the base64 alphabet.');
    }
    return $decoded;
  }
}
