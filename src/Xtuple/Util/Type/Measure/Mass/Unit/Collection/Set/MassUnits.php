<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Collection\Set;

use Xtuple\Util\Collection\Set\AbstractSet;
use Xtuple\Util\Type\Measure\Mass\Unit\MassUnit;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Gram;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Kilogram;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Ounce;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Pound;

final class MassUnits
  extends AbstractSet
  implements SetMassUnit {
  /** @var SetMassUnit */
  private $units;

  public function __construct() {
    $this->units = new ArraySetMassUnit([
      new Kilogram(),
      new Pound(),
      new Gram(),
      new Ounce(),
    ]);
    parent::__construct($this->units);
  }

  public function find(string $search): MassUnit {
    return $this->units->find($search);
  }
}
