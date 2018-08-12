<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Key;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Cache\Key\KeyStruct;

class PostgresKeyFromKeyTest
  extends TestCase {
  public function testConstructor() {
    $keys = ['cache', 'key', 'test'];
    $key = new PostgresKeyFromKey(new KeyStruct($keys));
    self::assertEquals('cache:key:test', $key->id());
    self::assertEquals($keys, $key->fields());
  }

  public function testSerialization() {
    $keys = ['cache', 'key', 'test'];
    $key = new PostgresKeyFromKey(new KeyStruct($keys));
    $serialized = serialize($key);
    self::assertEquals(
      'C:49:"Xtuple\Util\Postgres\Cache\Key\PostgresKeyFromKey":51:{a:3:{i:0;s:5:"cache";i:1;s:3:"key";i:2;s:4:"test";}}',
      $serialized
    );
    /** @var PostgresKeyFromKey $unserialized */
    $unserialized = unserialize($serialized);
    self::assertEquals($key->id(), $unserialized->id());
    self::assertEquals($key->fields(), $unserialized->fields());
  }
}
