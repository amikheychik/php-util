<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Unit;

use Xtuple\Util\Type\Measure\Mass\Unit\AbstractMassUnit;

final class Gram
  extends AbstractMassUnit {
  public function __construct() {
    parent::__construct('g', 'Gram', ['gm', 'gs', 'grams']);
  }

  public function toSI(float $mass): float {
    return 0.001 * $mass;
  }

  public function fromSI(float $mass): float {
    return 1000 * $mass;
  }
}
