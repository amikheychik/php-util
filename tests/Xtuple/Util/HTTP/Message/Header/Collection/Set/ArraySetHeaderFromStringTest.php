<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use PHPUnit\Framework\TestCase;

final class ArraySetHeaderFromStringTest
  extends TestCase {
  public function testString() {
    $fields = implode("\r\n", [
      'HTTP/1.1 200 OK',
      'Server: nginx',
      'Date: Thu, 05 Jan 2017 05:40:52 GMT',
      'Content-Type: text/html',
      'Location: https://httpbin.org/get',
      'Keywords: HTTP',
      'Keywords: HTTPS',
      '',
    ]);
    $headers = new ArraySetHeaderFromString($fields);
    self::assertEquals(5, $headers->count());
    self::assertEquals('Keywords: HTTP, HTTPS', (string) $headers->get('Keywords'));
  }
}
