<?php declare(strict_types=1);

namespace Xtuple\Util\JWT;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\JWT\Claim\Collection\Map\Base64\URLSafeBase64EncodedMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Header\HeaderMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Payload\PayloadMapClaim;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\URLSafeBase64EncodedStringFromString;

final class JWTStruct
  implements JWT {
  /** @var HeaderMapClaim */
  private $header;
  /** @var PayloadMapClaim */
  private $payload;

  public function __construct(HeaderMapClaim $header, PayloadMapClaim $payload) {
    $this->header = $header;
    $this->payload = $payload;
  }

  public function encoded(): string {
    $content = strtr('{header}.{payload}', [
      '{header}' => new URLSafeBase64EncodedMapClaim($this->header),
      '{payload}' => new URLSafeBase64EncodedMapClaim($this->payload),
    ]);
    try {
      if ($signature = $this->header->algorithm()->sign($content)) {
        return strtr('{content}.{signature}', [
          '{content}' => $content,
          '{signature}' => new URLSafeBase64EncodedStringFromString($signature),
        ]);
      }
      return $content;
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to encode JSON Web Token');
    }
  }

  public function header(): HeaderMapClaim {
    return $this->header;
  }

  public function payload(): PayloadMapClaim {
    return $this->payload;
  }
}
