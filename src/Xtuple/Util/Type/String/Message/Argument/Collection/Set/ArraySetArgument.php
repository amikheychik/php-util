<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument\Collection\Set;

use Xtuple\Util\Collection\Set\ArraySet\StrictType\AbstractStrictlyTypedArraySet;
use Xtuple\Util\Type\String\Message\Argument\Argument;

final class ArraySetArgument
  extends AbstractStrictlyTypedArraySet
  implements SetArgument {
  /**
   * @param Argument[] $elements
   */
  public function __construct(array $elements = []) {
    parent::__construct(Argument::class, $elements, 'key');
  }
}
