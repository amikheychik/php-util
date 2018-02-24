<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Collection\Set;

use Xtuple\Util\Collection\Set\Set;
use Xtuple\Util\Type\Measure\Mass\Unit\MassUnit;

interface SetMassUnit
  extends Set {
  /**
   * @throws \Throwable
   *
   * @param string $search
   *
   * @return MassUnit
   */
  public function find(string $search): MassUnit;

  /**
   * @param string $symbol
   *
   * @return MassUnit|null
   */
  public function get(string $symbol);

  /**
   * @return MassUnit|null
   */
  public function current();
}
