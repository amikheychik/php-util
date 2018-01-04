<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set\ArraySet\StrictType;

use Xtuple\Util\Collection\Set\ArraySet\AbstractArraySet;
use Xtuple\Util\Generics\Type\StrictType;

abstract class AbstractStrictlyTypedArraySet
  extends AbstractArraySet {
  public function __construct(string $type, iterable $elements = [], ?string $key = null) {
    if ($key && !method_exists($type, $key)) {
      throw new \InvalidArgumentException(strtr("Method {key}() is not defined in type \{type}", [
        '{key}' => $key,
        '{type}' => ltrim($type, '\\'),
      ]));
    }
    $strict = new StrictType($type);
    foreach ($elements as $element) {
      $strict->cast($element);
    }
    parent::__construct($elements, $key ? function ($element) use ($key) {
      return call_user_func([$element, $key]);
    } : null);
  }
}
