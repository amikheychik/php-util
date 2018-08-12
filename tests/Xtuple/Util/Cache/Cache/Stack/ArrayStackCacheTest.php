<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Cache\Stack;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Cache\Cache\Memory\MemoryCache;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\Cache\Record\RecordStruct;

class ArrayStackCacheTest
  extends TestCase {
  public function testCRUD() {
    $cache1 = new MemoryCache('cache1');
    $cache2 = new MemoryCache('cache2');
    $cache3 = new MemoryCache('cache3');
    $stack = new ArrayStackCache($cache1, $cache2, $cache3);
    $stack = unserialize(serialize($stack));
    /** @var StackCache $stack */
    self::assertTrue($stack->isEmpty());
    $key1 = new KeyStruct(['test1']);
    $record1 = new RecordStruct($key1, 'record1');
    $cache3->insert($record1);
    self::assertFalse($stack->isEmpty());
    self::assertNull($cache1->find($key1));
    self::assertNull($cache2->find($key1));
    self::assertEquals('record1', $stack->find($key1)->value());
    self::assertEquals('record1', $cache1->find($key1)->value());
    self::assertEquals('record1', $cache2->find($key1)->value());
    $key2 = new KeyStruct(['test2']);
    $record2 = new RecordStruct($key2, 'record2');
    self::assertNull($cache1->find($key2));
    self::assertNull($cache2->find($key2));
    self::assertNull($cache3->find($key2));
    self::assertEquals('record2', $stack->insert($record2)->value());
    self::assertEquals('record2', $cache1->insert($record2)->value());
    self::assertEquals('record2', $cache2->insert($record2)->value());
    self::assertEquals('record2', $cache3->insert($record2)->value());
    $stack->delete($key2);
    self::assertNull($stack->find($key2));
    self::assertNull($cache1->find($key2));
    self::assertNull($cache2->find($key2));
    self::assertNull($cache3->find($key2));
    $stack->clear();
    self::assertNull($stack->find($key1));
    self::assertNull($cache1->find($key1));
    self::assertNull($cache2->find($key1));
    self::assertNull($cache3->find($key1));
    self::assertTrue($stack->isEmpty());
  }
}
