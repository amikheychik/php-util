<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence\ArrayList\StrictType;

use Xtuple\Util\Collection\Sequence\ArrayList\AbstractArrayList;
use Xtuple\Util\Generics\Type\StrictType;

abstract class AbstractStrictlyTypedArrayList
  extends AbstractArrayList {
  public function __construct(string $type, iterable $elements = []) {
    $strict = new StrictType($type);
    foreach ($elements as $element) {
      $strict->cast($element);
    }
    parent::__construct($elements);
  }
}
