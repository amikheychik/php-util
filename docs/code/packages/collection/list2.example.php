<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Collection\Sequence\ArrayList\StrictType\StrictlyTypedArrayList;

// Effectively, $list is List<Countable>
/** @noinspection PhpUnhandledExceptionInspection - type of \ArrayObject is verified */
$list = new StrictlyTypedArrayList(\Countable::class, [
  new \ArrayObject([1]),
  new \ArrayObject([1, 2]),
]);

$list->get(0)->count() === 1;

foreach ($list as $k => $value) {
  // \Countable interface methods can be used without a type check,
  // as type is checked on input.
  $value->count();
}
