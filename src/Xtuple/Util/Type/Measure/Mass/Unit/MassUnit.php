<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit;

use Xtuple\Util\Type\Measure\Unit;

interface MassUnit
  extends Unit {
  public function is(MassUnit $unit): bool;
}
