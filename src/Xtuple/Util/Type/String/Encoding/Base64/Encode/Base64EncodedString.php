<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64\Encode;

final class Base64EncodedString
  implements Base64EncodedChars {
  /** @var string */
  private $encoded;

  public function __construct(string $encoded) {
    $this->encoded = $encoded;
  }

  public function __toString(): string {
    return $this->encoded;
  }
}
