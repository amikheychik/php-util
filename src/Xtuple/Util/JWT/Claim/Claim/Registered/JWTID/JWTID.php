<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\JWTID;

use Xtuple\Util\JWT\Claim\Claim;

/**
 * Interface JWTID - JWT ID
 */
interface JWTID
  extends Claim {
  public const NAME = 'jti';
}
