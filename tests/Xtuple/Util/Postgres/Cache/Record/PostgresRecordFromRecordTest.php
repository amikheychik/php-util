<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Record;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\Cache\Record\RecordStruct;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class PostgresRecordFromRecordTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testSerialization() {
    $key = new KeyStruct(['test', 'cache', 'record']);
    $value = (object) ['id' => 1, 'name' => 'Record 1'];
    $value->reference = $value;
    $now = time();
    $expire = $now + 3600;
    $record = new PostgresRecordFromRecord(
      new RecordStruct(
        $key,
        $value,
        new DateTimeTimestampSeconds($expire)
      ),
      $now
    );
    $serialized = serialize($record);
    /** @var PostgresRecordFromRecord $unserialized */
    $unserialized = unserialize($serialized);
    self::assertEquals($serialized, serialize($unserialized));
    self::assertEquals($record->key()->fields(), $unserialized->key()->fields());
    self::assertTrue($record->expiresAt()->equals($unserialized->expiresAt()));
    self::assertEquals($record->value()->name, $unserialized->value()->name);
    self::assertEquals($unserialized->value(), $unserialized->value()->reference);
  }

  /**
   * @throws \Throwable
   */
  public function testRow() {
    $key = new KeyStruct(['test', 'cache', 'record']);
    $now = time();
    $expire = $now + 3600;
    // Object values with cyclic reference
    $value = (object) ['id' => 1, 'name' => 'Record 1'];
    $value->reference = $value;
    $record = new PostgresRecordFromRecord(
      new RecordStruct(
        $key,
        $value,
        new DateTimeTimestampSeconds($expire)
      ),
      $now
    );
    self::assertEquals($key->fields(), $record->key()->fields());
    self::assertEquals($value, $record->value());
    /** @noinspection SpellCheckingInspection */
    self::assertEquals([
      ':cid' => 'test:cache:record',
      ':data' => 'Tzo4OiJzdGRDbGFzcyI6Mzp7czoyOiJpZCI7aToxO3M6NDoibmFtZSI7czo4OiJSZWNvcmQgMSI7czo5OiJyZWZlcmVuY2UiO3I6MTt9',
      ':expire' => $expire,
      ':created' => $now,
      ':serialized' => 1,
    ], $record->row());
    // Scalar value
    $value = 'Test value';
    $record = new PostgresRecordFromRecord(
      new RecordStruct(
        $key,
        $value,
        new DateTimeTimestampSeconds($expire)
      ),
      $now
    );
    self::assertEquals($key->fields(), $record->key()->fields());
    self::assertEquals($value, $record->value());
    self::assertEquals([
      ':cid' => 'test:cache:record',
      ':data' => $value,
      ':expire' => $expire,
      ':created' => $now,
      ':serialized' => 0,
    ], $record->row());
    // Record without expiration
    $record = new PostgresRecordFromRecord(
      new RecordStruct($key, $value),
      $now
    );
    self::assertEquals($key->fields(), $record->key()->fields());
    self::assertEquals($value, $record->value());
    self::assertNull($record->expiresAt());
    self::assertEquals([
      ':cid' => 'test:cache:record',
      ':data' => $value,
      ':expire' => 0,
      ':created' => $now,
      ':serialized' => 0,
    ], $record->row());
  }
}
