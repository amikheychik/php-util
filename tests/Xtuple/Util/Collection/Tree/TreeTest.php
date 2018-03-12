<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Tree;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Collection\Tree\ArrayTree\ArrayTree;

class TreeTest
  extends TestCase {
  public function testArrayTree() {
    $tree = new TestTree();
    self::assertTrue($tree->isEmpty());
    self::assertEquals(0, $tree->count());
    self::assertNull($tree->get(['contact']));
    self::assertNull($tree->get(['contact', 'name']));
    self::assertNull($tree->set(['contact', 'name'], 'xTuple'));
    self::assertEquals('xTuple', $tree->get(['contact', 'name']));
    self::assertEquals('xTuple', $tree->remove(['contact', 'name']));
    self::assertNull($tree->remove(['contact', 'company', 'name']));
    self::assertFalse($tree->isEmpty());
    self::assertEquals(1, $tree->count());
    self::assertEquals([
      'contact' => [],
    ], $tree->data());
    $tree = new TestTree([
      'contact' => [
        'name' => 'xTuple',
        'address' => [
          'city' => 'Norfolk',
        ],
      ],
      'projects' => [
        'php-util',
        'php-api',
        'php-xdruple',
      ],
    ]);
    self::assertFalse($tree->isEmpty());
    self::assertEquals(2, $tree->count());
    self::assertEquals('xTuple', $tree->get(['contact', 'name']));
    self::assertEquals('Norfolk', $tree->get(['contact', 'address', 'city']));
    self::assertNull($tree->set(['contact', 'address', 'state'], 'VA'));
    self::assertEquals('VA', $tree->get(['contact', 'address', 'state']));
    self::assertEquals('php-xdruple', $tree->get(['projects', 2]));
    self::assertNull($tree->set(['projects', 4], 'php-xdruple-commerce'));
    $projects = [
      0 => 'php-util',
      1 => 'php-api',
      2 => 'php-xdruple',
      4 => 'php-xdruple-commerce',
    ];
    self::assertEquals($projects, $tree->get(['projects']));
    foreach (new TestTree($tree->get(['projects'])) as $key => $value) {
      self::assertEquals($projects[$key], $value);
    }
    $tree->remove(['contact']);
    self::assertEquals([
      0 => 'php-util',
      1 => 'php-api',
      2 => 'php-xdruple',
      4 => 'php-xdruple-commerce',
    ], $tree->remove(['projects']));
    self::assertTrue($tree->isEmpty());
    self::assertEquals(0, $tree->count());
    self::assertEquals([], $tree->data());
    self::assertNull($tree->get(['contact', 'address', 'city']));
    self::assertNull($tree->get(['contact', 'address']));
  }
}

final class TestTree
  extends AbstractTree {
  public function __construct(array $data = []) {
    parent::__construct(new ArrayTree($data));
  }
}
