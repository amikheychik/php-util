<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set\ArraySet\StrictType;

use Xtuple\Util\Collection\Exception\ElementTypeException;
use Xtuple\Util\Collection\Set\ArraySet\AbstractArraySet;
use Xtuple\Util\Exception\Undefined\Method\UndefinedMethodException;
use Xtuple\Util\Generics\Type\StrictType;

abstract class AbstractStrictlyTypedArraySet
  extends AbstractArraySet {
  /**
   * @throws \Throwable - argument $key is set, but method doesn't exist in type $type; or element is of the wrong type.
   *
   * @param string      $type
   * @param iterable    $elements
   * @param null|string $key
   */
  public function __construct(string $type, iterable $elements = [], ?string $key = null) {
    if ($key && !method_exists($type, $key)) {
      throw new UndefinedMethodException($type, $key);
    }
    $strict = new StrictType($type);
    foreach ($elements as $i => $element) {
      try {
        $strict->cast($element);
      }
      catch (\Throwable $e) {
        throw new ElementTypeException((string) $i, $strict, $element, $e);
      }
    }
    parent::__construct($elements, $key ? function ($element) use ($key) {
      return call_user_func([$element, $key]);
    } : null);
  }
}
