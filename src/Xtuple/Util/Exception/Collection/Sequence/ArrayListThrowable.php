<?php declare(strict_types=1);

namespace Xtuple\Util\Exception\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\ArrayList\StrictType\AbstractStrictlyTypedArrayList;

final class ArrayListThrowable
  extends AbstractStrictlyTypedArrayList
  implements ListThrowable {
  /**
   * @throws \Throwable - if elements is of the wrong type.
   *
   * @param \Throwable[] $elements
   */
  public function __construct(array $elements = []) {
    parent::__construct(\Throwable::class, $elements);
  }
}
