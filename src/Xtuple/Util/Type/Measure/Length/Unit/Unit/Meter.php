<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit\Unit;

use Xtuple\Util\Type\Measure\Length\Unit\AbstractLengthUnit;

final class Meter
  extends AbstractLengthUnit {
  public function __construct() {
    parent::__construct('m', 'Meter', ['meters', 'metre', 'metres']);
  }

  public function toSI(float $length): float {
    return $length;
  }

  public function fromSI(float $length): float {
    return $length;
  }
}
