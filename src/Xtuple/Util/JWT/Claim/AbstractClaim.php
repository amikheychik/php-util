<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim;

abstract class AbstractClaim
  implements Claim {
  /** @var Claim */
  private $claim;

  public function __construct(Claim $claim) {
    $this->claim = $claim;
  }

  public final function __toString(): string {
    return $this->claim->__toString();
  }

  public final function name(): string {
    return $this->claim->name();
  }

  public final function value() {
    return $this->claim->value();
  }
}
