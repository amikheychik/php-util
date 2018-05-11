<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence\ArrayList\StrictType;

use Xtuple\Util\Collection\Sequence\ArrayList\AbstractArrayList;
use Xtuple\Util\Generics\Type\Exception\ElementTypeException;
use Xtuple\Util\Generics\Type\StrictType;

abstract class AbstractStrictlyTypedArrayList
  extends AbstractArrayList {
  /**
   * @throws \Throwable - if elements is of the wrong type.
   *
   * @param string   $type
   * @param iterable $elements
   */
  public function __construct(string $type, iterable $elements = []) {
    $strict = new StrictType($type);
    foreach ($elements as $i => $element) {
      try {
        $strict->cast($element);
      }
      catch (\Throwable $e) {
        throw new ElementTypeException((string) $i, $strict->fqn(), $element, $e);
      }
    }
    parent::__construct($elements);
  }
}
