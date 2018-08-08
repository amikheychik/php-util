<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Header;

use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\Algorithm;
use Xtuple\Util\JWT\Claim\Collection\Map\AbstractMapClaim;

/** @noinspection LongInheritanceChainInspection */

abstract class AbstractHeaderMapClaim
  extends AbstractMapClaim
  implements HeaderMapClaim {
  /** @var HeaderMapClaim */
  private $claims;

  public function __construct(HeaderMapClaim $claims) {
    parent::__construct($claims);
    $this->claims = $claims;
  }

  public function algorithm(): Algorithm {
    return $this->claims->algorithm();
  }
}
