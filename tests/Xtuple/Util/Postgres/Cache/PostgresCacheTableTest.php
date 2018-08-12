<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache;

use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\Cache\Record\RecordStruct;
use Xtuple\Util\Postgres\PDO\Query\Parameter\Table\TableString;
use Xtuple\Util\Postgres\PDO\Test\PDODatabaseTestCase;
use Xtuple\Util\Postgres\Query\QueryStruct;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class PostgresCacheTableTest
  extends PDODatabaseTestCase {
  /** @var PostgresCacheTable */
  private $cache;

  /**
   * @throws \Throwable
   */
  public function setUp() {
    parent::setUp();
    try {
      $this->environment->database()->query(new QueryStruct("
        CREATE TABLE cache (
          cid varchar(255) DEFAULT ''::character varying NOT NULL CONSTRAINT cache_pkey PRIMARY KEY,
          data bytea,
          expire integer DEFAULT 0 NOT NULL,
          created integer DEFAULT 0 NOT NULL,
          serialized integer DEFAULT 0 NOT NULL CONSTRAINT cache_serialized_check CHECK (serialized >= 0)
        );
      "));
      $this->environment->database()->query(new QueryStruct('
        CREATE INDEX cache_expire_idx ON cache (expire);
      '));
      $this->cache = new PostgresCacheTable($this->environment->connection(), new TableString('cache'));
    }
    catch (\Exception $e) {
      self::markTestSkipped($e->getMessage());
    }
  }

  /**
   * @throws \Throwable
   */
  protected function tearDown() {
    parent::tearDown();
    $this->environment->database()->query(new QueryStruct('DROP TABLE cache'));
  }

  public function testSerialization() {
    $serialized = serialize($this->cache);
    self::assertEquals($serialized, serialize(unserialize($serialized)));
  }

  /**
   * @throws \Throwable
   */
  public function testCache() {
    $now = time();
    $key = new KeyStruct(['phpunit', 'postgres', $now]);
    $expiredRecord = new RecordStruct($key, 'Expired test record', new DateTimeTimestampSeconds($now - 3600));
    $cacheRecord = new RecordStruct($key, 'Test record', new DateTimeTimestampSeconds($now + 3600));
    $this->cache->clear();
    self::assertTrue($this->cache->isEmpty());
    $this->cache->insert($expiredRecord);
    self::assertNull($this->cache->find($key));
    self::assertTrue($this->cache->isEmpty());
    $this->cache->insert($cacheRecord);
    self::assertNotNull($this->cache->find($key));
    self::assertFalse($this->cache->isEmpty());
    $record = $this->cache->find($key);
    self::assertEquals($cacheRecord->value(), $record->value());
    $this->cache->delete($key);
    self::assertNull($this->cache->find($key));
    self::assertTrue($this->cache->isEmpty());
  }

  /**
   * @throws \Throwable
   */
  public function testKeyOverride() {
    $now = time();
    $key = new KeyStruct(['XdCustomer', 'admin', 0, 'GUEST']);
    $record = new RecordStruct($key, 'Guest Customer');
    $this->cache->clear();
    $this->cache->insert($record);
    self::assertNotNull($this->cache->find($key));
    $record = new RecordStruct($key, 'Guest Customer Updated');
    $this->cache->insert($record);
    self::assertNotNull($this->cache->find($key));
    $record = new RecordStruct($key, 'Guest Customer Expired', new DateTimeTimestampSeconds($now - 3600));
    $this->cache->insert($record);
    self::assertTrue($this->cache->isEmpty());
    self::assertNull($this->cache->find($key));
    $record = new RecordStruct($key, 'Guest Customer Not Expired', new DateTimeTimestampSeconds($now + 3600));
    $this->cache->insert($record);
    self::assertNotNull($this->cache->find($key));
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Can not delete cache record XdCustomer:admin:0:GUEST from Postgres table cache_test
   * @throws \Throwable
   */
  public function testDeleteException() {
    $key = new KeyStruct(['XdCustomer', 'admin', 0, 'GUEST']);
    $this->cache->clear();
    $this->cache->delete($key);
    // Non-existing table
    $cache = new PostgresCacheTable($this->environment->connection(), new TableString('cache_test'));
    $cache->delete($key);
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Can not write cache record XdCustomer:admin:0:GUEST into Postgres table cache_test
   * @throws \Throwable
   */
  public function testWriteException() {
    $key = new KeyStruct(['XdCustomer', 'admin', 0, 'GUEST']);
    $record = new RecordStruct($key, 'Guest Customer');
    // Non-existing table
    $cache = new PostgresCacheTable($this->environment->connection(), new TableString('cache_test'));
    $cache->insert($record);
  }

  /**
   * @throws \Throwable
   */
  public function testReadException() {
    $key = new KeyStruct(['XdCustomer', 'admin', 0, 'GUEST']);
    // Non-existing table
    $cache = new PostgresCacheTable($this->environment->connection(), new TableString('cache_test'));
    self::assertNull($cache->find($key));
  }

  /**
   * @throws \Throwable
   */
  public function testSlashEscape() {
    $cache = new PostgresCacheTable($this->environment->connection(), new TableString('cache'));
    $key = new KeyStruct(['test']);
    $value = ["Xtuple\\Util"];
    $record = $cache->insert(new RecordStruct($key, $value));
    self::assertEquals($value, $record->value());
    self::assertEquals($value, $cache->find($key)->value());
    $value = ["Xtuple\\Util\\\\Storage\\\\\\Postgres\\\\\\\\Cache"];
    $record = $cache->insert(new RecordStruct($key, $value));
    self::assertEquals($value, $record->value());
    self::assertEquals($value, $cache->find($key)->value());
  }
}
