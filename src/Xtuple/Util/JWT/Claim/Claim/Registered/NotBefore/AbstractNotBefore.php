<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\NotBefore;

use Xtuple\Util\JWT\Claim\Type\NumericDate\AbstractNumericDateClaim;

abstract class AbstractNotBefore
  extends AbstractNumericDateClaim
  implements NotBefore {
  public function __construct(NotBefore $claim) {
    parent::__construct($claim);
  }
}
