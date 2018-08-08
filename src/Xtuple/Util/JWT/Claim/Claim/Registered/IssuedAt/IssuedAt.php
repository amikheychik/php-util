<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt;

use Xtuple\Util\JWT\Claim\Type\NumericDate\NumericDateClaim;

interface IssuedAt
  extends NumericDateClaim {
  public const NAME = 'iat';
}
