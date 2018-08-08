<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\JWTID;

use Xtuple\Util\JWT\Claim\AbstractClaim;
use Xtuple\Util\JWT\Claim\ClaimStruct;

final class JWTIDStruct
  extends AbstractClaim
  implements JWTID {
  public function __construct(string $value) {
    parent::__construct(new ClaimStruct(JWTID::NAME, $value));
  }
}
