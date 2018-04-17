<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit\Collection\Set;

use Xtuple\Util\Collection\Set\AbstractSet;
use Xtuple\Util\Type\Measure\Length\Unit\LengthUnit;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Centimeter;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Inch;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Meter;

final class LengthUnits
  extends AbstractSet
  implements SetLengthUnit {
  /** @var SetLengthUnit */
  private $units;

  public function __construct() {
    /** @noinspection PhpUnhandledExceptionInspection - elements have different keys */
    $this->units = new ArraySetLengthUnit([
      new Meter(),
      new Centimeter(),
      new Inch(),
    ]);
    parent::__construct($this->units);
  }

  public function find(string $search): LengthUnit {
    return $this->units->find($search);
  }
}
