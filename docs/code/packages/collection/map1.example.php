<?php
declare(strict_types=1);

use Xtuple\Util\Collection\Map\ArrayMap\ArrayMap;

// Array's default keys are casted to string
$map = new ArrayMap([1, 2 => 'two', 'three' => 3]);

// Note: parameter is string
$map->get('0'); // returns 1
$map->get('1'); // returns null
$map->get('2'); // returns 'two'
$map->get('three'); // returns 3

// Mapping callback can be specified to be used instead of default keys
$map = new ArrayMap([
  ['code' => 'US', 'name' => 'United States'],
  ['code' => 'CA', 'name' => 'Canada'],
], function ($element) {
  return $element['code'];
});

// Returns ['code' => 'US, 'name' => 'United States']
$map->get('US');
