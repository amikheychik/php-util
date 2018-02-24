<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Unit;

use Xtuple\Util\Type\Measure\Mass\Unit\AbstractMassUnit;

final class Kilogram
  extends AbstractMassUnit {
  public function __construct() {
    parent::__construct('kg', 'Kilogram', ['kgs', 'kilo', 'kilos', 'kilograms']);
  }

  public function toSI(float $mass): float {
    return $mass;
  }

  public function fromSI(float $mass): float {
    return $mass;
  }
}
