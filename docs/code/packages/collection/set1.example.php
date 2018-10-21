<?php
declare(strict_types=1);

use Xtuple\Util\Collection\Set\ArraySet\ArraySet;

/** @noinspection PhpUnhandledExceptionInspection - code keys are unique */
$map = new ArraySet([1, 2 => 'two', 'three' => 3]);
// Array's default keys are casted to string
$map->get('0'); // returns 1
$map->get('1'); // returns null
$map->get('2'); // returns 'two'
$map->get('three'); // returns 3

/** @noinspection PhpUnhandledExceptionInspection - code keys are unique */
$map = new ArraySet([
  ['code' => 'US', 'name' => 'United States'],
  ['code' => 'CA', 'name' => 'Canada'],
], function ($element) {
  // Mapping callback can be specified to be used instead of default keys
  return $element['code'];
});

// Returns ['code' => 'US, 'name' => 'United States']
$map->get('US');

try {
  $map = new ArraySet([
    ['code' => 'US', 'name' => 'United States'],
    ['code' => 'CA', 'name' => 'Canada'],
    ['code' => 'US', 'name' => 'USA'],
  ], function ($element) {
    return $element['code'];
  });
}
catch (Throwable $e) {
  // Throws an exception, as 'code' => 'US' is duplicated.
}
