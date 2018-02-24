<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit;

use Xtuple\Util\Type\Measure\AbstractUnit;

abstract class AbstractLengthUnit
  extends AbstractUnit
  implements LengthUnit {
  public final function is(LengthUnit $unit): bool {
    return $this->symbol() === $unit->symbol();
  }
}
