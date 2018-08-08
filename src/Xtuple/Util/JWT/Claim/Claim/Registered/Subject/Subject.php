<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Subject;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\StringOrURIClaim;

interface Subject
  extends StringOrURIClaim {
  public const NAME = 'sub';
}
