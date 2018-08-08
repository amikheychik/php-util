<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map;

use Xtuple\Util\Collection\Map\ArrayMap\StrictType\AbstractStrictlyTypedArrayMap;
use Xtuple\Util\JWT\Claim\Claim;

/**
 * Class ArrayMap<Claim>
 */
final class ArrayMapClaim
  extends AbstractStrictlyTypedArrayMap
  implements MapClaim {
  /**
   * @throws \Throwable
   *
   * @param iterable|Claim[] $elements
   */
  public function __construct(iterable $elements = []) {
    parent::__construct(Claim::class, $elements, 'name');
  }
}
