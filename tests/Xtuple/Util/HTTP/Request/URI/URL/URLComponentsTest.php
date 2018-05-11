<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use PHPUnit\Framework\TestCase;

class URLComponentsTest
  extends TestCase {
  public function testConstructor() {
    $url = new URLComponents([
      'scheme' => 'https',
      'host' => 'example.com',
      'port' => 80,
      'user' => 'example',
      'pass' => 'secret',
      'path' => '/path/to/resource',
      'query' => 'sort=ASC',
      'fragment' => 'body',
    ]);
    self::assertEquals('https://example:secret@example.com:80/path/to/resource?sort=ASC#body', (string) $url);
    self::assertEquals('https', $url->scheme());
    self::assertEquals('example.com', $url->host());
    self::assertEquals(80, $url->port());
    self::assertEquals('example', $url->user());
    self::assertEquals('secret', $url->password());
    self::assertEquals('/path/to/resource', $url->path());
    self::assertEquals('sort=ASC', $url->query());
    self::assertEquals('body', $url->fragment());
  }
}
