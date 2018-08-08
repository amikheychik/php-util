<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm;

use Xtuple\Util\JWT\Claim\AbstractClaim;
use Xtuple\Util\JWT\Claim\ClaimStruct;

abstract class AbstractAlgorithm
  extends AbstractClaim
  implements Algorithm {
  public function __construct(string $algorithm) {
    parent::__construct(new ClaimStruct(Algorithm::NAME, $algorithm));
  }
}
