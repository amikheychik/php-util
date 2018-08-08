<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\JWTID;

use Xtuple\Util\JWT\Claim\AbstractClaim;

abstract class AbstractJWTID
  extends AbstractClaim
  implements JWTID {
  public function __construct(JWTID $claim) {
    parent::__construct($claim);
  }
}
