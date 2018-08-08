<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\ExpirationTime;

use Xtuple\Util\JWT\Claim\Type\NumericDate\NumericDateClaim;

interface ExpirationTime
  extends NumericDateClaim {
  public const NAME = 'exp';
}
