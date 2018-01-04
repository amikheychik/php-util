<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Map\ArrayMap;

use PHPUnit\Framework\TestCase;

class ArrayMapTest
  extends TestCase {
  public function testMap() {
    $map = new ArrayMap([
      'key' => 'value',
    ]);
    self::assertEquals('value', $map->get('key'));
    self::assertEquals(null, $map->get('value'));
    self::assertEquals(1, $map->count());
    self::assertFalse($map->isEmpty());
    foreach ($map as $k => $v) {
      self::assertEquals('key', $k);
      self::assertEquals('value', $v);
    }
  }

  public function testCallable() {
    $map = new ArrayMap([
      ['key', 'value'],
    ], function ($element) {
      return $element[0];
    });
    self::assertEquals(['key', 'value'], $map->get('key'));
    self::assertEquals(null, $map->get('value'));
    self::assertEquals(1, $map->count());
    self::assertFalse($map->isEmpty());
    foreach ($map as $k => $v) {
      self::assertEquals('key', $k);
      self::assertEquals(['key', 'value'], $v);
    }
  }
}
