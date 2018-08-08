<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Issuer;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\AbstractStringOrURIClaim;
use Xtuple\Util\JWT\Claim\Type\StringOrURI\StringOrURIClaimStruct;

final class IssuerStruct
  extends AbstractStringOrURIClaim
  implements Issuer {
  public function __construct(string $issuer) {
    parent::__construct(new StringOrURIClaimStruct(Issuer::NAME, $issuer));
  }
}
