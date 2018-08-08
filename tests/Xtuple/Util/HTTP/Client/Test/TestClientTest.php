<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Test;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromString;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\Collection\Map\ArrayMapRequest;
use Xtuple\Util\HTTP\Request\Method\Method\POST;
use Xtuple\Util\HTTP\Request\RequestStruct;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;

class TestClientTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testSend() {
    $client = new TestClient();
    $result = $client->send(new RequestStruct(
      new POST(),
      new URLString('https://example.com'),
      null,
      new StringBodyFromString('Test')
    ));
    self::assertEquals('https://example.com', $result->key());
    self::assertEquals('1.1', $result->response()->status()->version());
    self::assertEquals(200, $result->response()->status()->code());
    self::assertEquals('OK', $result->response()->status()->reason());
    self::assertEquals('Test', (string) new StringBodyFromBody($result->response()->body()));
    $results = $client->sendMany(new ArrayMapRequest([
      new RequestStruct(
        new POST(),
        new URLString('https://example.com'),
        null,
        new StringBodyFromString('Test')
      ),
      new RequestStruct(
        new POST(),
        new URLString('https://example.com'),
        new ArraySetHeader([
          new HeaderStruct('Response-Code', (string) 404),
          new HeaderStruct('Response-Reason', 'Not found'),
        ]),
        null
      ),
    ]));
    $result = $results->get('0');
    self::assertEquals('0', $result->key());
    self::assertEquals('1.1', $result->response()->status()->version());
    self::assertEquals(200, $result->response()->status()->code());
    self::assertEquals('OK', $result->response()->status()->reason());
    self::assertEquals('Test', (string) new StringBodyFromBody($result->response()->body()));
    $result = $results->get('1');
    self::assertEquals('1', $result->key());
    self::assertEquals('1.1', $result->response()->status()->version());
    self::assertEquals(404, $result->response()->status()->code());
    self::assertEquals('Not found', $result->response()->status()->reason());
    self::assertEquals('', (string) new StringBodyFromBody($result->response()->body()));
  }

  /**
   * @expectedException \Xtuple\Util\HTTP\Client\Exception\Throwable
   * @expectedExceptionMessage No requests
   * @throws \Throwable
   */
  public function testSendManyException() {
    $client = new TestClient();
    $client->sendMany(new ArrayMapRequest([]));
  }

  /**
   * @expectedException \Xtuple\Util\HTTP\Client\Exception\Throwable
   * @expectedExceptionMessage Exception test
   * @throws \Throwable
   */
  public function testSendResponseError() {
    $client = new TestClient();
    $client->send(new RequestStruct(
      new POST(),
      new URLString('https://example.com'),
      new ArraySetHeader([
        new HeaderStruct('Response-Error', 'Exception test'),
      ]),
      null
    ))->response()->status();
  }
}
