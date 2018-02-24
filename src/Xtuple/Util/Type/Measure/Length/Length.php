<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length;

use Xtuple\Util\Type\Measure\Length\Unit\LengthUnit;

interface Length {
  public function value(): float;

  public function unit(): LengthUnit;

  public function in(LengthUnit $unit): Length;
}
