<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Throwable;

class URLStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $url = new URLStruct('https', 'example.com', 80, 'example', 'secret', 'path/to/resource', 'sort=ASC', 'body');
    self::assertEquals('https://example:secret@example.com:80/path/to/resource?sort=ASC#body', (string) $url);
    self::assertEquals('https', $url->scheme());
    self::assertEquals('example.com', $url->host());
    self::assertEquals(80, $url->port());
    self::assertEquals('example', $url->user());
    self::assertEquals('secret', $url->password());
    self::assertEquals('/path/to/resource', $url->path());
    self::assertEquals('sort=ASC', $url->query());
    self::assertEquals('body', $url->fragment());
    $this->expectException(Throwable::class);
    $this->expectExceptionMessage('Failed to build a correct URL from the passed arguments');
    new URLStruct('https');
  }
}
