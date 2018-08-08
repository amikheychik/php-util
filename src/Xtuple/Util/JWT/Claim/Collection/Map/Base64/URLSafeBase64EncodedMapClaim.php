<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Base64;

use Xtuple\Util\JWT\Claim\Collection\Map\MapClaim;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\JSON\URLSafeBase64JSONEncodedArray;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\URLSafeBase64EncodedChars;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\URLSafeBase64EncodedStringFromString;

final class URLSafeBase64EncodedMapClaim
  implements URLSafeBase64EncodedChars {
  /** @var MapClaim */
  private $claims;

  public function __construct(MapClaim $claims) {
    $this->claims = $claims;
  }

  public function __toString(): string {
    $data = [];
    foreach ($this->claims as $claim) {
      $data[$claim->name()] = $claim->value();
    }
    return (string) ($data
      ? new URLSafeBase64JSONEncodedArray($data)
      : new URLSafeBase64EncodedStringFromString('{}')
    );
  }
}
