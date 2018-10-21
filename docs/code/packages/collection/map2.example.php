<?php
declare(strict_types=1);

use Xtuple\Util\Collection\Map\ArrayMap\StrictType\StrictlyTypedArrayMap;

// $map is Map<string, \stdClass>
/** @noinspection PhpUnhandledExceptionInspection - type is verified */
$map = new StrictlyTypedArrayMap(\stdClass::class, [
  'US' => (object) ['code' => 'US', 'name' => 'United States'],
  'CA' => (object) ['code' => 'CA', 'name' => 'Canada'],
]);

// $key parameter can be specified to provide name of the key method.
// Key method must not require any parameters.
/** @noinspection PhpUnhandledExceptionInspection - type is verified */
$map = new StrictlyTypedArrayMap(\Countable::class, [
  new \ArrayObject([1]),
  new \ArrayObject([1, 2]),
  new \ArrayObject([2]),
], 'count');

// Returns ArrayObject([1, 2]), as its count() returned 2
$map->get('2');

// Returns ArrayObject([2]), as it overrides earlier provided ArrayObject([1])
$map->get('1');
