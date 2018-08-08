<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Type;

use Xtuple\Util\JWT\Claim\AbstractClaim;
use Xtuple\Util\JWT\Claim\ClaimStruct;

final class TypeStruct
  extends AbstractClaim
  implements Type {
  public function __construct(string $value) {
    parent::__construct(new ClaimStruct(Type::NAME, $value));
  }
}
