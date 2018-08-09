<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Tree\ArrayTree;

use PHPUnit\Framework\TestCase;

class DistinctRecursiveMergeArrayTreeTest
  extends TestCase {
  public function testConstructor() {
    $merged = new DistinctRecursiveMergeArrayTree([
      'int' => 42,
      'float' => 3.1415,
      'array' => [
        'string' => 'Example',
        'bool' => true,
        'array' => [
          'null' => null,
        ],
      ],
    ]);
    self::assertEquals([
      'int' => 42,
      'float' => 3.1415,
      'array' => [
        'string' => 'Example',
        'bool' => true,
        'array' => [
          'null' => null,
        ],
      ],
    ], $merged->data());
    $object = new \stdClass();
    $merged = new DistinctRecursiveMergeArrayTree([
      'int' => 42,
      'float' => 3.1415,
      'array' => [
        'string' => 'Example',
        'bool' => true,
        'array' => [
          'null' => null,
        ],
      ],
    ], [
      'float' => 2.7182,
      'array' => [
        'bool' => false,
        'null' => null,
      ],
    ], [
      'object' => $object,
      'array' => [
        'string' => 'Override',
        'array' => [
          'int' => 42,
        ],
      ],
    ]);
    self::assertEquals([
      'int' => 42,
      'float' => 2.7182,
      'array' => [
        'string' => 'Override',
        'bool' => false,
        'array' => [
          'null' => null,
          'int' => 42,
        ],
        'null' => null,
      ],
      'object' => $object,
    ], $merged->data());
  }
}
