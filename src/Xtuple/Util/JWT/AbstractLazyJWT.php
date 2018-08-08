<?php declare(strict_types=1);

namespace Xtuple\Util\JWT;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\JWT\Claim\Collection\Map\Header\HeaderMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Payload\PayloadMapClaim;

abstract class AbstractLazyJWT
  implements JWT {
  public final function encoded(): string {
    try {
      $jwt = new JWTStruct($this->header(), $this->payload());
    }
    catch (Throwable $e) {
      throw new ChainException($e, 'Failed to create a new JSON Web Token');
    }
    return $jwt->encoded();
  }

  /**
   * @throws Throwable
   * @return HeaderMapClaim
   */
  public abstract function header(): HeaderMapClaim;

  /**
   * @throws Throwable
   * @return PayloadMapClaim
   */
  public abstract function payload(): PayloadMapClaim;
}
