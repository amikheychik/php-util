<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Collection\Tree\ArrayTree\ArrayTree;

$tree = new ArrayTree([
  'name' => 'xtuple/util',
  'require' => [
    'php' => '^7.1',
    'ext-intl' => '*',
    'ext-SimpleXML' => '*',
    'lib-openssl' => '*',
  ],
]);

$tree->isEmpty() === false;
$tree->count() === 2; // counts number of first-level elements

// Note: get(), set(), remove() require an array of strings and integers.
$tree->get(['name']) === 'xtuple/util';

$tree->set(['description'], 'xTuple PHP utility classes') === null; // returns previous value of (nested) property
$tree->set(['require', 'php'], '^7.2') === '^7.1';

$tree->remove(['require', 'lib-openssl']) === '*'; // returns last value of the (nested) property

// Current data may be retrieved as an array
$tree->data() === [
  'name' => 'xtuple/util',
  'description' => 'xTuple PHP utility classes',
  'require' => [
    'php' => '^7.2',
    'ext-intl' => '*',
    'ext-SimpleXML' => '*',
  ],
];
