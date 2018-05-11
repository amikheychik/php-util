<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Map\ArrayMap\StrictType;

use Xtuple\Util\Collection\Map\ArrayMap\AbstractArrayMap;
use Xtuple\Util\Exception\Undefined\Method\UndefinedMethodException;
use Xtuple\Util\Generics\Type\Exception\ElementTypeException;
use Xtuple\Util\Generics\Type\StrictType;

abstract class AbstractStrictlyTypedArrayMap
  extends AbstractArrayMap {
  /**
   * @throws \Throwable - argument $key is set, but method doesn't exist in type $type; or element is of the wrong type.
   *
   * @param string      $type
   * @param iterable    $elements
   * @param null|string $key
   */
  public function __construct(string $type, iterable $elements = [], ?string $key = null) {
    if (!is_null($key) && !method_exists($type, $key)) {
      throw new UndefinedMethodException($type, $key);
    }
    $strict = new StrictType($type);
    foreach ($elements as $i => $element) {
      try {
        $strict->cast($element);
      }
      catch (\Throwable $e) {
        throw new ElementTypeException((string) $i, $strict->fqn(), $element, $e);
      }
    }
    parent::__construct($elements, $key ? function ($element) use ($key) {
      return call_user_func([$element, $key]);
    } : null);
  }
}
