<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Type\StringOrURI;

use Xtuple\Util\JWT\Claim\AbstractClaim;

abstract class AbstractStringOrURIClaim
  extends AbstractClaim
  implements StringOrURIClaim {
  public function __construct(StringOrURIClaim $claim) {
    parent::__construct($claim);
  }
}
