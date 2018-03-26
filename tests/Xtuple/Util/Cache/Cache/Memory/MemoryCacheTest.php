<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Cache\Memory;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\Cache\Record\RecordStruct;
use Xtuple\Util\Type\DateTime\DateTimeString;

final class MemoryCacheTest
  extends TestCase {
  public function testCacheInterface() {
    $cache = new MemoryCache('test');
    $cache->insert(new RecordStruct(new KeyStruct(['system', 'user', 1]), 'Bond'));
    $cache->insert(new RecordStruct(
      new KeyStruct(['system', 'user', 2]),
      'James Bond',
      new DateTimeString('-1 hour')
    ));
    $cache->insert(new RecordStruct(
      new KeyStruct(['system', 'user', 3]),
      'John Doe',
      new DateTimeString('+1 hour')
    ));
    self::assertEquals('Bond', $cache->find(new KeyStruct(['system', 'user', 1]))->value());
    self::assertNotNull($cache->find(new KeyStruct(['system', 'user', 1])));
    self::assertNull($cache->find(new KeyStruct(['system', 'user', 2])));
    $cache->delete(new KeyStruct(['system', 'user', 1]));
    self::assertNull($cache->find(new KeyStruct(['system', 'user', 1])));
    self::assertNotNull($cache->find(new KeyStruct(['system', 'user', 3])));
    $cache->insert(new RecordStruct(
      new KeyStruct(['system', 'user', 3, 'name']),
      'John Doe'
    ));
    self::assertNull($cache->find(new KeyStruct(['system', 'user', 3])));
    self::assertNotNull($cache->find(new KeyStruct(['system', 'user', 3, 'name'])));
    $cache->clear();
    self::assertNull($cache->find(new KeyStruct(['system', 'user', 3, 'name'])));
    self::assertNull($cache->find(new KeyStruct(['system', 'user', 2])));
  }

  public function testSerializableInterface() {
    $cache = new MemoryCache('test');
    $cache->insert(new RecordStruct(new KeyStruct(['system', 'user', '1']), 'Bond'));
    $serialized = serialize($cache);
    self::assertEquals(
      'C:42:"Xtuple\Util\Cache\Cache\Memory\MemoryCache":4:{test}',
      $serialized
    );
    $cache->insert(new RecordStruct(new KeyStruct(['user-1', 'user', '1']), 'James Bond'));
    $cache = new MemoryCache('test2');
    self::assertNull($cache->find(new KeyStruct(['system', 'user', '1'])));
    /** @var MemoryCache $cache */
    $cache = unserialize($serialized);
    self::assertNotNull($cache->find(new KeyStruct(['system', 'user', '1'])));
    /** @var MemoryCache $restored */
    $restored = unserialize($serialized);
    self::assertEquals('James Bond', $restored->find(new KeyStruct(['user-1', 'user', '1']))->value());
  }

  public function testBucket() {
    $cache1 = new MemoryCache('test1');
    $cache2 = new MemoryCache('test2');
    $cache1->insert(new RecordStruct(new KeyStruct(['system', 'user', '1']), 'Bond'));
    $cache2->insert(new RecordStruct(new KeyStruct(['system', 'user', '1']), 'James Bond'));
    self::assertEquals('Bond', $cache1->find(new KeyStruct(['system', 'user', '1']))->value());
    $cache3 = new MemoryCache('test1');
    self::assertEquals('Bond', $cache3->find(new KeyStruct(['system', 'user', '1']))->value());
    $cache1->clear();
    self::assertEquals('James Bond', $cache2->find(new KeyStruct(['system', 'user', '1']))->value());
  }

  public function testClearAndEmpty() {
    $cache = new MemoryCache('test');
    $cache->clear();
    self::assertTrue($cache->isEmpty());
    $cache->insert(new RecordStruct(new KeyStruct(['system', 'user', '1']), 'Bond'));
    self::assertFalse($cache->isEmpty());
    $cache->insert(new RecordStruct(new KeyStruct(['system', 'user', '2']), 'Bond'));
    $cache->delete(new KeyStruct(['system', 'user', '1']));
    self::assertFalse($cache->isEmpty());
    $cache->delete(new KeyStruct(['system', 'user', '2']));
    self::assertTrue($cache->isEmpty());
    $cache->insert(new RecordStruct(new KeyStruct(['system', 'user', '1']), 'Bond'));
    $cache->clear();
    self::assertTrue($cache->isEmpty());
  }
}
