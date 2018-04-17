<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set\ArraySet\StrictType;

use Xtuple\Util\Collection\Set\ArraySet\AbstractArraySet;
use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Exception;
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
      throw new Exception("Method {key}() is not defined in type \{type}", [
        'key' => $key,
        'type' => ltrim($type, '\\'),
      ]);
    }
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
    parent::__construct($elements, $key ? function ($element) use ($key) {
      return call_user_func([$element, $key]);
    } : null);
  }
}
