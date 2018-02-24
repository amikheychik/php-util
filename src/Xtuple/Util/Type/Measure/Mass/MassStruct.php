<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass;

use Xtuple\Util\Type\Measure\Mass\Unit\MassUnit;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Kilogram;

final class MassStruct
  implements Mass {
  /** @var float */
  private $value;
  /** @var MassUnit */
  private $unit;

  public function __construct(float $value, ?MassUnit $unit = null) {
    $this->value = $value;
    $this->unit = $unit ?: new Kilogram();
  }

  public function value(): float {
    return $this->value;
  }

  public function unit(): MassUnit {
    return $this->unit;
  }

  public function in(MassUnit $unit): Mass {
    return new MassStruct(
      $unit->fromSI($this->unit->toSI($this->value)),
      $unit
    );
  }
}
