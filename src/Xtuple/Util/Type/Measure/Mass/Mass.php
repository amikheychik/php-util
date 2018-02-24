<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass;

use Xtuple\Util\Type\Measure\Mass\Unit\MassUnit;

interface Mass {
  public function value(): float;

  public function unit(): MassUnit;

  public function in(MassUnit $unit): Mass;
}
