<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Type\NumericDate;

use Xtuple\Util\JWT\Claim\AbstractClaim;
use Xtuple\Util\JWT\Claim\ClaimStruct;
use Xtuple\Util\Type\DateTime\DateTime;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampDateTime;

final class NumericDateClaimStruct
  extends AbstractClaim
  implements NumericDateClaim {
  /** @var DateTime */
  private $value;

  public function __construct(string $name, DateTime $value) {
    parent::__construct(new ClaimStruct($name, (new TimestampDateTime($value))->seconds()));
    $this->value = $value;
  }

  public function datetime(): DateTime {
    return $this->value;
  }
}
