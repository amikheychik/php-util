<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit;

use Xtuple\Util\Type\Measure\AbstractUnit;

abstract class AbstractMassUnit
  extends AbstractUnit
  implements MassUnit {
  public final function is(MassUnit $unit): bool {
    return $this->symbol() === $unit->symbol();
  }
}
