<?php declare(strict_types=1);

namespace Xtuple\Util\JWT;

use Xtuple\Util\JWT\Claim\Collection\Map\Header\HeaderMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Payload\PayloadMapClaim;

abstract class AbstractJWT
  implements JWT {
  /** @var JWT */
  private $jwt;

  public function __construct(JWT $jwt) {
    $this->jwt = $jwt;
  }

  public final function encoded(): string {
    return $this->jwt->encoded();
  }

  public final function header(): HeaderMapClaim {
    return $this->jwt->header();
  }

  public final function payload(): PayloadMapClaim {
    return $this->jwt->payload();
  }
}
