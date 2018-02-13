<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\JSON;

use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\URLSafeBase64EncodedStringFromString;

final class URLSafeBase64JSONEncodedArray
  implements URLSafeBase64JSONEncodedChars {
  /** @var array */
  private $data;

  public function __construct(array $data) {
    $this->data = $data;
  }

  public function __toString(): string {
    return (string) new URLSafeBase64EncodedStringFromString(json_encode($this->data));
  }
}
