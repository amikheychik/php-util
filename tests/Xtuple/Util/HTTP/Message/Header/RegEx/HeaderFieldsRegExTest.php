<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\RegEx;

use PHPUnit\Framework\TestCase;

class HeaderFieldsRegExTest
  extends TestCase {
  public function testRegEx() {
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
    $regex = new HeaderFieldsRegEx();
    $matches = $regex->all($fields, true);
    self::assertEquals('Server', $matches[0]['name']);
    self::assertEquals('nginx', $matches[0]['value']);
    self::assertEquals('Date', $matches[1]['name']);
    self::assertEquals('Thu, 05 Jan 2017 05:40:52 GMT', $matches[1]['value']);
    self::assertEquals('Content-Type', $matches[2]['name']);
    self::assertEquals('text/html', $matches[2]['value']);
    self::assertEquals('Location', $matches[3]['name']);
    self::assertEquals('https://httpbin.org/get', $matches[3]['value']);
    self::assertEquals('Keywords', $matches[4]['name']);
    self::assertEquals('HTTP', $matches[4]['value']);
    self::assertEquals('Keywords', $matches[5]['name']);
    self::assertEquals('HTTPS', $matches[5]['value']);
    self::assertFalse(isset($matches[6]));
  }
}
