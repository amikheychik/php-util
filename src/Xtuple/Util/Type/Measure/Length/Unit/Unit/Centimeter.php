<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit\Unit;

use Xtuple\Util\Type\Measure\Length\Unit\AbstractLengthUnit;

final class Centimeter
  extends AbstractLengthUnit {
  public function __construct() {
    parent::__construct('cm', 'Centimeter', ['centimetre', 'centimetres', 'centimeters']);
  }

  public function toSI(float $length): float {
    return 0.01 * $length;
  }

  public function fromSI(float $length): float {
    return 100 * $length;
  }
}
