<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit\Collection\Set;

use Xtuple\Util\Collection\Set\Set;
use Xtuple\Util\Type\Measure\Length\Unit\LengthUnit;

interface SetLengthUnit
  extends Set {
  /**
   * @throws \Throwable
   *
   * @param string $search
   *
   * @return LengthUnit
   */
  public function find(string $search): LengthUnit;

  /**
   * @param string $key
   *
   * @return LengthUnit|null
   */
  public function get(string $key);

  /**
   * @return LengthUnit|null
   */
  public function current();
}
