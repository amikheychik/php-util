<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Collection\Set;

use Xtuple\Util\Collection\Set\ArraySet\StrictType\AbstractStrictlyTypedArraySet;
use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Type\Measure\Mass\Unit\MassUnit;

final class ArraySetMassUnit
  extends AbstractStrictlyTypedArraySet
  implements SetMassUnit {
  /**
   * @param MassUnit[]|iterable $elements
   * @param bool                $mapped
   */
  public function __construct(iterable $elements = [], bool $mapped = false) {
    parent::__construct(MassUnit::class, $elements, $mapped ? null : 'symbol');
  }

  /**
   * {@inheritdoc}
   */
  public function find(string $search): MassUnit {
    $search = strtolower($search);
    foreach ($this as $symbol => $unit) {
      /** @var MassUnit $unit */
      if (in_array($search, array_merge([strtolower($symbol)], $unit->synonyms()))) {
        return $unit;
      }
    }
    throw new Exception('Mass unit {search} is not supported', [
      'search' => $search,
    ]);
  }
}
