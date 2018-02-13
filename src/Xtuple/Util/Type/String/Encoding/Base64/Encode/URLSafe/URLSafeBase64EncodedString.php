<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe;

use Xtuple\Util\Type\String\Encoding\Base64\Encode\Base64EncodedChars;

/**
 * @see http://us.php.net/manual/en/function.base64-encode.php#103849
 */
final class URLSafeBase64EncodedString
  implements URLSafeBase64EncodedChars {
  /** @var Base64EncodedChars */
  private $encoded;

  public function __construct(Base64EncodedChars $encoded) {
    $this->encoded = $encoded;
  }

  public function __toString(): string {
    return trim(strtr((string) $this->encoded, '+/', '-_'), '=');
  }
}
