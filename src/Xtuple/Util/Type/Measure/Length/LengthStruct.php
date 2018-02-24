<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length;

use Xtuple\Util\Type\Measure\Length\Unit\LengthUnit;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Meter;

final class LengthStruct
  implements Length {
  /** @var float */
  private $value;
  /** @var LengthUnit */
  private $unit;

  public function __construct(float $value, ?LengthUnit $unit = null) {
    $this->value = $value;
    $this->unit = $unit ?: new Meter();
  }

  public function value(): float {
    return $this->value;
  }

  public function unit(): LengthUnit {
    return $this->unit;
  }

  public function in(LengthUnit $unit): Length {
    return new LengthStruct(
      $unit->fromSI($this->unit->toSI($this->value)),
      $unit
    );
  }
}
