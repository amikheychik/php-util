<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status;

use PHPUnit\Framework\TestCase;

final class StatusStructTest
  extends TestCase {
  public function testConstructor() {
    $status = new TestStatus(new StatusStruct('1.1', 200, 'OK'));
    self::assertEquals('HTTP/1.1 200 OK', (string) $status);
    self::assertEquals('1.1', $status->version());
    self::assertEquals(200, $status->code());
    self::assertEquals('OK', $status->reason());
  }
}

final class TestStatus
  extends AbstractStatus {
}
