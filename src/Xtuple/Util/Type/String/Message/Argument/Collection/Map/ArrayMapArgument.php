<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument\Collection\Map;

use Xtuple\Util\Collection\Map\ArrayMap\StrictType\AbstractStrictlyTypedArrayMap;
use Xtuple\Util\Type\String\Message\Argument\Argument;

final class ArrayMapArgument
  extends AbstractStrictlyTypedArrayMap
  implements MapArgument {
  /**
   * @throws \Throwable - if an element is of the wrong type
   *
   * @param Argument[]|iterable $elements
   */
  public function __construct(iterable $elements = []) {
    parent::__construct(Argument::class, $elements, 'key');
  }
}
