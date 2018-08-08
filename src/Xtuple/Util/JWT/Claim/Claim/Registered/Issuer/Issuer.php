<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Issuer;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\StringOrURIClaim;

interface Issuer
  extends StringOrURIClaim {
  public const NAME = 'iss';
}
