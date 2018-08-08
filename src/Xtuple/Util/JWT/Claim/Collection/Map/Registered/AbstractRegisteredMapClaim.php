<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Registered;

use Xtuple\Util\JWT\Claim\Collection\Map\AbstractMapClaim;

/** @noinspection LongInheritanceChainInspection */

abstract class AbstractRegisteredMapClaim
  extends AbstractMapClaim
  implements RegisteredMapClaim {
  public function __construct(RegisteredMapClaim $claims) {
    parent::__construct($claims);
  }
}
