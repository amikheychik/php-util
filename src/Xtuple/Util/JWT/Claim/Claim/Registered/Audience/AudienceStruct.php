<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Audience;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\AbstractStringOrURIClaim;
use Xtuple\Util\JWT\Claim\Type\StringOrURI\StringOrURIClaimStruct;

final class AudienceStruct
  extends AbstractStringOrURIClaim
  implements Audience {
  public function __construct(string $audience) {
    parent::__construct(new StringOrURIClaimStruct(Audience::NAME, $audience));
  }
}
