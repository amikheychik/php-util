<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Payload;

use Xtuple\Util\JWT\Claim\Collection\Map\AbstractMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\MapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Registered\RegisteredMapClaim;

/** @noinspection LongInheritanceChainInspection */

abstract class AbstractPayloadMapClaim
  extends AbstractMapClaim
  implements PayloadMapClaim {
  /** @var PayloadMapClaim */
  private $claims;

  public function __construct(PayloadMapClaim $claims) {
    parent::__construct($claims);
    $this->claims = $claims;
  }

  public final function registered(): RegisteredMapClaim {
    return $this->claims->registered();
  }

  public final function public(): MapClaim {
    return $this->claims->public();
  }

  public final function private(): MapClaim {
    return $this->claims->private();
  }
}
