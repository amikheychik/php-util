<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Unit;

use Xtuple\Util\Type\Measure\Mass\Unit\AbstractMassUnit;

final class Ounce
  extends AbstractMassUnit {
  public function __construct() {
    parent::__construct('oz', 'Ounce', ['ounces']);
  }

  public function toSI(float $mass): float {
    return 0.028349523125 * $mass;
  }

  public function fromSI(float $mass): float {
    return 35.27396195 * $mass;
  }
}
