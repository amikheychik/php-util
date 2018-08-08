<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\ExpirationTime;

use Xtuple\Util\JWT\Claim\Type\NumericDate\AbstractNumericDateClaim;

abstract class AbstractExpirationTime
  extends AbstractNumericDateClaim
  implements ExpirationTime {
  public function __construct(ExpirationTime $claim) {
    parent::__construct($claim);
  }
}
