<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe;

abstract class AbstractURLSafeBase64EncodedString
  implements URLSafeBase64EncodedChars {
  /** @var URLSafeBase64EncodedChars */
  private $encoded;

  public function __construct(URLSafeBase64EncodedChars $encoded) {
    $this->encoded = $encoded;
  }

  public final function __toString(): string {
    return $this->encoded->__toString();
  }
}
