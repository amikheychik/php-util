<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Payload;

use Xtuple\Util\JWT\Claim\Collection\Map\AbstractMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\MapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\MergedMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Registered\RegisteredMapClaim;

final class PayloadMapClaimStruct
  extends AbstractMapClaim
  implements PayloadMapClaim {
  /** @var RegisteredMapClaim */
  private $registered;
  /** @var MapClaim */
  private $public;
  /** @var MapClaim */
  private $private;

  public function __construct(RegisteredMapClaim $registered, MapClaim $public, MapClaim $private) {
    parent::__construct(new MergedMapClaim($registered, $public, $private));
    $this->registered = $registered;
    $this->public = $public;
    $this->private = $private;
  }

  public function registered(): RegisteredMapClaim {
    return $this->registered;
  }

  public function public(): MapClaim {
    return $this->public;
  }

  public function private(): MapClaim {
    return $this->private;
  }
}
