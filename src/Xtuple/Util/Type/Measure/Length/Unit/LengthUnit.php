<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit;

use Xtuple\Util\Type\Measure\Unit;

interface LengthUnit
  extends Unit {
  public function is(LengthUnit $unit): bool;
}
