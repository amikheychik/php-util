<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence\ArrayList\StrictType;

use Xtuple\Util\Collection\Sequence\ArrayList\AbstractArrayList;
use Xtuple\Util\Exception\ChainException;
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
        throw new ChainException($e, 'All elements must be \{type}. Element {index} of type \{given} given.', [
          'index' => $i,
          'type' => ltrim($type, '\\'),
          'given' => ltrim(gettype($element) === 'object' ? get_class($element) : gettype($element), '\\'),
        ]);
      }
    }
    parent::__construct($elements);
  }
}
