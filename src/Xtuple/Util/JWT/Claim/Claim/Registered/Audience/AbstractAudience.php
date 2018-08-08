<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Audience;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\AbstractStringOrURIClaim;

abstract class AbstractAudience
  extends AbstractStringOrURIClaim
  implements Audience {
  public function __construct(Audience $claim) {
    parent::__construct($claim);
  }
}
