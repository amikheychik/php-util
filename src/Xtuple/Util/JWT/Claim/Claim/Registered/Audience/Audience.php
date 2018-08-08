<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Audience;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\StringOrURIClaim;

interface Audience
  extends StringOrURIClaim {
  public const NAME = 'aud';
}
