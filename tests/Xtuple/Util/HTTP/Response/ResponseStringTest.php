<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Response\Exception\ResponseParsingException;
use Xtuple\Util\RegEx\String\NewLineRegEx;
use Xtuple\Util\Type\Stream\String\StringStreamFromResource;

final class ResponseStringTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    /** @noinspection SpellCheckingInspection */
    $response = (new NewLineRegEx())->replace("\r\n", <<<EOT
HTTP/1.1 302 FOUND
Connection: keep-alive
Server: gunicorn/19.7.1
Date: Fri, 04 May 2018 21:03:31 GMT
Content-Type: text/html; charset=utf-8
Content-Length: 0
Location: /get
Access-Control-Allow-Origin: *
Access-Control-Allow-Credentials: true
X-Powered-By: Flask
X-Processed-Time: 0
Via: 1.1 vegur

HTTP/1.1 200 OK
Connection: keep-alive
Server: gunicorn/19.7.1
Date: Fri, 04 May 2018 21:03:31 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *
Access-Control-Allow-Credentials: true
X-Powered-By: Flask
X-Processed-Time: 0
Content-Length: 181
Via: 1.1 vegur

{"test": "content"}
EOT
    );
    $response = new ResponseString($response);
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('181', $response->headers()->get('Content-Length')->value());
    self::assertNull($response->headers()->get('Location'));
    self::assertEquals('{"test": "content"}', (string) new StringStreamFromResource($response->body()->resource()));
  }

  /**
   * @throws \Throwable
   */
  public function testParsingException() {
    $this->expectException(ResponseParsingException::class);
    new ResponseString('');
  }
}
