<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Unit;

use Xtuple\Util\Type\Measure\Mass\Unit\AbstractMassUnit;

final class Pound
  extends AbstractMassUnit {
  public function __construct() {
    parent::__construct('lb', 'Pound', ['lb', 'lbs', 'pound', 'pounds']);
  }

  public function toSI(float $mass): float {
    return 0.453592 * $mass;
  }

  public function fromSI(float $mass): float {
    return 2.20462442 * $mass;
  }
}
