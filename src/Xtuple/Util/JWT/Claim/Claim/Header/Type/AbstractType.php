<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Type;

use Xtuple\Util\JWT\Claim\AbstractClaim;

abstract class AbstractType
  extends AbstractClaim
  implements Type {
  public function __construct(Type $claim) {
    parent::__construct($claim);
  }
}
