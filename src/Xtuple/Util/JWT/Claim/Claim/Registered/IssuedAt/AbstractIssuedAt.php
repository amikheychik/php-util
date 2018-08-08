<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt;

use Xtuple\Util\JWT\Claim\Type\NumericDate\AbstractNumericDateClaim;

abstract class AbstractIssuedAt
  extends AbstractNumericDateClaim
  implements IssuedAt {
  public function __construct(IssuedAt $claim) {
    parent::__construct($claim);
  }
}
