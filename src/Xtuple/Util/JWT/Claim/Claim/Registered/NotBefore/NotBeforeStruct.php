<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\NotBefore;

use Xtuple\Util\JWT\Claim\Type\NumericDate\AbstractNumericDateClaim;
use Xtuple\Util\JWT\Claim\Type\NumericDate\NumericDateClaimStruct;
use Xtuple\Util\Type\DateTime\DateTime;

final class NotBeforeStruct
  extends AbstractNumericDateClaim
  implements NotBefore {
  public function __construct(DateTime $value) {
    parent::__construct(new NumericDateClaimStruct(NotBefore::NAME, $value));
  }
}
