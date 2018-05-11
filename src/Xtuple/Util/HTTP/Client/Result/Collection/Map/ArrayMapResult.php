<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Result\Collection\Map;

use Xtuple\Util\Collection\Map\ArrayMap\StrictType\AbstractStrictlyTypedArrayMap;
use Xtuple\Util\HTTP\Client\Result\Result;

final class ArrayMapResult
  extends AbstractStrictlyTypedArrayMap
  implements MapResult {
  /**
   * @throws \Throwable - if $results contains element of a wrong type
   *
   * @param Result[]|iterable $results
   */
  public function __construct(iterable $results) {
    parent::__construct(Result::class, $results, 'key');
  }
}
