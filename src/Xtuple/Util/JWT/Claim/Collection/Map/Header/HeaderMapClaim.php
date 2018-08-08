<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Header;

use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\Algorithm;
use Xtuple\Util\JWT\Claim\Collection\Map\MapClaim;

interface HeaderMapClaim
  extends MapClaim {
  public function algorithm(): Algorithm;
}
