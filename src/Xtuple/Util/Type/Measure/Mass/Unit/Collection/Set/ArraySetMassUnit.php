<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Collection\Set;

use Xtuple\Util\Collection\Set\ArraySet\StrictType\AbstractStrictlyTypedArraySet;
use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Type\Measure\Mass\Unit\MassUnit;

final class ArraySetMassUnit
  extends AbstractStrictlyTypedArraySet
  implements SetMassUnit {
  /**
   * @throws \Throwable - if a duplicate element exists.
   *
   * @param MassUnit[]|iterable $elements
   * @param bool                $mapped
   */
  public function __construct(iterable $elements = [], bool $mapped = false) {
    parent::__construct(MassUnit::class, $elements, $mapped ? null : 'symbol');
  }

  public function find(string $search): MassUnit {
    $search = strtolower($search);
    foreach ($this as $symbol => $unit) {
      /** @var MassUnit $unit */
      if (in_array($search, array_merge([strtolower($symbol)], $unit->synonyms()), true)) {
        return $unit;
      }
    }
    throw new Exception('Mass unit {search} is not supported', [
      'search' => $search,
    ]);
  }
}
