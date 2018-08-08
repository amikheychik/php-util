<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\NotBefore;

use Xtuple\Util\JWT\Claim\Type\NumericDate\NumericDateClaim;

interface NotBefore
  extends NumericDateClaim {
  public const NAME = 'nbf';
}
