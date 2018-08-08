<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Type;

use Xtuple\Util\JWT\Claim\Claim;

interface Type
  extends Claim {
  public const NAME = 'typ';
}
