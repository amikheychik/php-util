<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Response\Exception\ResponseParsingException;
use Xtuple\Util\RegEx\String\NewLineRegEx;
use Xtuple\Util\Type\Stream\StreamStruct;
use Xtuple\Util\Type\Stream\String\StringStreamFromResource;

final class ResponseStreamsTest
  extends TestCase {
  /** @var string */
  private $header;
  /** @var string */
  private $body;

  public function setUp() {
    parent::setUp();
    /** @noinspection SpellCheckingInspection */
    $this->header = (new NewLineRegEx())->replace("\r\n", <<<EOT
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
Content-Length: 19
Via: 1.1 vegur


EOT
    );
    $this->body = '{"test": "content"}';
  }

  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $header = tmpfile();
    fwrite($header, $this->header);
    $body = tmpfile();
    fwrite($body, $this->body);
    $response = new ResponseStreams(new StreamStruct($header), new StreamStruct($body));
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('19', $response->headers()->get('Content-Length')->value());
    self::assertNull($response->headers()->get('Location'));
    self::assertEquals('{"test": "content"}', (string) new StringStreamFromResource($response->body()->resource()));
  }

  /**
   * @throws \Throwable
   */
  public function testParsingException() {
    $this->expectException(ResponseParsingException::class);
    $header = tmpfile();
    fwrite($header, 'Content-Length: 19');
    $body = tmpfile();
    fwrite($body, $this->body);
    new ResponseStreams(new StreamStruct($header), new StreamStruct($body));
  }

  /**
   * @throws \Throwable
   */
  public function testStreamException() {
    $header = tmpfile();
    fwrite($header, $this->header);
    $body = tmpfile();
    fwrite($body, $this->body);
    $bodyStream = new StreamStruct($body);
    $this->expectException(ResponseParsingException::class);
    fclose($body);
    new ResponseStreams(new StreamStruct($header), $bodyStream);
  }
}
