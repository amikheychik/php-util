<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit\Collection\Set;

use Xtuple\Util\Collection\Set\ArraySet\StrictType\AbstractStrictlyTypedArraySet;
use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Type\Measure\Length\Unit\LengthUnit;

final class ArraySetLengthUnit
  extends AbstractStrictlyTypedArraySet
  implements SetLengthUnit {
  /**
   * @param LengthUnit[]|iterable $elements
   * @param bool                  $mapped
   */
  public function __construct(iterable $elements = [], bool $mapped = false) {
    parent::__construct(LengthUnit::class, $elements, $mapped ? null : 'symbol');
  }

  /**
   * {@inheritdoc}
   */
  public function find(string $search): LengthUnit {
    $search = strtolower($search);
    foreach ($this as $symbol => $unit) {
      /** @var LengthUnit $unit */
      if (in_array($search, array_merge([strtolower($symbol)], $unit->synonyms()))) {
        return $unit;
      }
    }
    throw new Exception('Length unit {search} is not supported', [
      'search' => $search,
    ]);
  }
}
