<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Throwable;

final class StatusFromStreamTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $status = tmpfile();
    fwrite($status, 'HTTP/1.1 200 OK');
    $status = new StatusFromStream($status);
    self::assertEquals('1.1', $status->version());
    self::assertEquals(200, $status->code());
    self::assertEquals('OK', $status->reason());
  }

  /**
   * @throws \Throwable
   */
  public function testException() {
    $status = tmpfile();
    fwrite($status, '200 OK');
    $this->expectException(Throwable::class);
    new StatusFromStream($status);
  }
}
