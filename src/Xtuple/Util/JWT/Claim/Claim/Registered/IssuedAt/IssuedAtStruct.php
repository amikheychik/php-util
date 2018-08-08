<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt;

use Xtuple\Util\JWT\Claim\Type\NumericDate\AbstractNumericDateClaim;
use Xtuple\Util\JWT\Claim\Type\NumericDate\NumericDateClaimStruct;
use Xtuple\Util\Type\DateTime\DateTime;

final class IssuedAtStruct
  extends AbstractNumericDateClaim
  implements IssuedAt {
  public function __construct(DateTime $value) {
    parent::__construct(new NumericDateClaimStruct(IssuedAt::NAME, $value));
  }
}
