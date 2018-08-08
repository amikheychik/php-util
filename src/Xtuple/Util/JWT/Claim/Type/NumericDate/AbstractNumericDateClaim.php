<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Type\NumericDate;

use Xtuple\Util\JWT\Claim\AbstractClaim;
use Xtuple\Util\Type\DateTime\DateTime;

abstract class AbstractNumericDateClaim
  extends AbstractClaim
  implements NumericDateClaim {
  /** @var NumericDateClaim */
  private $claim;

  public function __construct(NumericDateClaim $claim) {
    parent::__construct($claim);
    $this->claim = $claim;
  }

  public final function datetime(): DateTime {
    return $this->claim->datetime();
  }
}
