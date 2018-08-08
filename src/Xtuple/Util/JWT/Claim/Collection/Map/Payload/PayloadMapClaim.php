<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Payload;

use Xtuple\Util\JWT\Claim\Collection\Map\MapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Registered\RegisteredMapClaim;

interface PayloadMapClaim
  extends MapClaim {
  public function registered(): RegisteredMapClaim;

  public function public(): MapClaim;

  public function private(): MapClaim;
}
