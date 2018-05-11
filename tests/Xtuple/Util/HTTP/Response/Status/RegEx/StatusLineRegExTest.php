<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status\RegEx;

use PHPUnit\Framework\TestCase;

class StatusLineRegExTest
  extends TestCase {
  public function testRegEx() {
    $regex = new StatusLineRegEx();
    self::assertEquals([
      'HTTP/1.1 404 Not found',
      'version' => '1.1',
      '1.1',
      'code' => '404',
      '404',
      'reason' => 'Not found',
      'Not found',
    ], $regex->matches('HTTP/1.1 404 Not found'));
    self::assertEquals([], $regex->matches('HTTP 1.1 404 Not found'));
  }
}
