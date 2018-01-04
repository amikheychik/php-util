<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Map;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Collection\Map\ArrayMap\ArrayMap;

class MapTestTest
  extends TestCase {
  public function testMap() {
    $map = new TestMap(new ArrayMap([
      'key' => 'value',
    ]));
    self::assertEquals('value', $map->get('key'));
    self::assertEquals(null, $map->get('value'));
    self::assertEquals(1, $map->count());
    self::assertFalse($map->isEmpty());
    foreach ($map as $k => $v) {
      self::assertEquals('key', $k);
      self::assertEquals('value', $v);
    }
  }
}

class TestMap
  extends AbstractMap {
}
