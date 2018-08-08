<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Issuer;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\AbstractStringOrURIClaim;

abstract class AbstractIssuer
  extends AbstractStringOrURIClaim
  implements Issuer {
  public function __construct(Issuer $claim) {
    parent::__construct($claim);
  }
}
