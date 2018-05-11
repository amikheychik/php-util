<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Throwable;

class URLStringTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $url = new URLString('https://example:secret@example.com:80/path/to/resource?sort=ASC#body');
    self::assertEquals('https', $url->scheme());
    self::assertEquals('example.com', $url->host());
    self::assertEquals(80, $url->port());
    self::assertEquals('example', $url->user());
    self::assertEquals('secret', $url->password());
    self::assertEquals('/path/to/resource', $url->path());
    self::assertEquals('sort=ASC', $url->query());
    self::assertEquals('body', $url->fragment());
    self::assertEquals('https://example:secret@example.com:80/path/to/resource?sort=ASC#body', (string) $url);
    $url = new URLString('http://username:secret@hostname:9090/path/to/resource?arg=value#anchor');
    self::assertEquals('http', $url->scheme());
    self::assertEquals('username', $url->user());
    self::assertEquals('secret', $url->password());
    self::assertEquals('hostname', $url->host());
    self::assertEquals(9090, $url->port());
    self::assertEquals('/path/to/resource', $url->path());
    self::assertEquals('arg=value', $url->query());
    self::assertEquals('anchor', $url->fragment());
    self::assertEquals('http://username:secret@hostname:9090/path/to/resource?arg=value#anchor', (string) $url);
  }

  /**
   * @throws \Throwable
   */
  public function testEmptyURL() {
    $this->expectException(Throwable::class);
    new URLString('');
  }

  /**
   * @throws \Throwable
   */
  public function testParseException() {
    $this->expectException(Throwable::class);
    new URLString('https://');
  }

  /**
   * @throws \Throwable
   */
  public function testParseEmptyHostException() {
    $this->expectException(Throwable::class);
    new URLString('http:/example.com');
  }
}
