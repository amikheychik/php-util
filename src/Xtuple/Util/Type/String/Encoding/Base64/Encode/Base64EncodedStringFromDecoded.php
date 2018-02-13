<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64\Encode;

use Xtuple\Util\Type\String\Encoding\Base64\Decode\Base64DecodedChars;

final class Base64EncodedStringFromDecoded
  implements Base64EncodedChars {
  /** @var Base64DecodedChars */
  private $data;

  public function __construct(Base64DecodedChars $data) {
    $this->data = $data;
  }

  public function __toString(): string {
    return base64_encode((string) $this->data);
  }
}
