<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Record;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\Type\DateTime\DateTimeString;

class RecordTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testStruct() {
    $expires = new DateTimeString('+1 hour');
    $record = new TestRecord(new RecordStruct(new KeyStruct(['system', 'user']), 'admin', $expires));
    self::assertEquals(new KeyStruct(['system', 'user']), $record->key());
    self::assertEquals('admin', $record->value());
    self::assertEquals($expires, $record->expiresAt());
  }
}

final class TestRecord
  extends AbstractRecord {
}
