<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit\Unit;

use Xtuple\Util\Type\Measure\Length\Unit\AbstractLengthUnit;

final class Inch
  extends AbstractLengthUnit {
  public function __construct() {
    parent::__construct('in', 'Inch', ['inches']);
  }

  public function toSI(float $length): float {
    return 0.0254 * $length;
  }

  public function fromSI(float $length): float {
    return 39.37007874 * $length;
  }
}
