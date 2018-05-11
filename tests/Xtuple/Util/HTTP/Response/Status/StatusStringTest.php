<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Response\Status\Exception\StatusLineParsingException;

final class StatusStringTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $status = new StatusString('HTTP/1.1 200 OK');
    self::assertEquals('1.1', $status->version());
    self::assertEquals(200, $status->code());
    self::assertEquals('OK', $status->reason());
  }

  /**
   * @throws \Throwable
   */
  public function testParsingException() {
    $this->expectException(StatusLineParsingException::class);
    new StatusString('200 OK');
  }
}
