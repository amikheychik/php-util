<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use PHPUnit\Framework\TestCase;

final class ArraySetHeaderFromStreamTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testStream() {
    $stream = tmpfile();
    fwrite($stream, implode("\r\n", [
      'HTTP/1.1 200 OK',
      'Server: nginx',
      'Date: Thu, 05 Jan 2017 05:40:52 GMT',
      'Content-Type: text/html',
      'Location: https://httpbin.org/get',
      'Keywords: HTTP',
      'Keywords: HTTPS',
      '',
    ]));
    $headers = new ArraySetHeaderFromStream($stream);
    self::assertEquals('Keywords: HTTP, HTTPS', (string) $headers->get('Keywords'));
  }
}
