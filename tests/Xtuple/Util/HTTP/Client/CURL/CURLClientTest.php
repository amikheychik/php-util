<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Client\CURL\Configuration\DebugConfiguration;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Body\String\QueryBody;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\Collection\Map\ArrayMapRequest;
use Xtuple\Util\HTTP\Request\Method\Method\DELETE;
use Xtuple\Util\HTTP\Request\Method\Method\GET;
use Xtuple\Util\HTTP\Request\Method\Method\POST;
use Xtuple\Util\HTTP\Request\Method\Method\PUT;
use Xtuple\Util\HTTP\Request\Request\DELETERequest;
use Xtuple\Util\HTTP\Request\RequestStruct;
use Xtuple\Util\HTTP\Request\URI\URL\AbstractBaseURL;
use Xtuple\Util\HTTP\Request\URI\URL\URLComponents;
use Xtuple\Util\HTTP\Response\JSON\JSONResponseStruct;

class CURLClientTest
  extends TestCase {
  /** @var CURLClient */
  private $httpClient;

  public function setUp() {
    $this->httpClient = new CURLClient(new DebugConfiguration());
  }

  /**
   * @throws \Throwable
   */
  public function testGet() {
    $response = $this->httpClient->send(
      new RequestStruct(new GET(), new HTTPBinURL('get?id=1'))
    )->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    $body = (new JSONResponseStruct($response))->json();
    self::assertEquals('https://httpbin.org/get?id=1', $body->get(['url']));
    self::assertEquals('1', $body->get(['args', 'id']));
  }

  /**
   * @throws \Throwable
   */
  public function testRedirect() {
    $response = $this->httpClient->send(
      new RequestStruct(new GET(), new HTTPBinURL('redirect/6'))
    )->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    self::assertEquals('https://httpbin.org/get', (new JSONResponseStruct($response))->json()->get(['url']));
    $response = $this->httpClient->send(
      new RequestStruct(new GET(), new HTTPBinURL('redirect-to?url=https://httpbin.org/get?id=1'))
    )->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    $body = (new JSONResponseStruct($response))->json();
    self::assertEquals('https://httpbin.org/get?id=1', $body->get(['url']));
    self::assertEquals('1', $body->get(['args', 'id']));
  }

  /**
   * @throws \Throwable
   */
  public function testPost() {
    $response = $this->httpClient->send(
      new RequestStruct(new POST(), new HTTPBinURL('post'), new ArraySetHeader([
        new HeaderStruct('Content-Type', 'application/json'),
      ]), new JSONBodyData([
        'test' => 'value',
      ]))
    )->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    $body = (new JSONResponseStruct($response))->json();
    self::assertEquals('https://httpbin.org/post', $body->get(['url']));
    self::assertEquals('value', $body->get(['json', 'test']));
    $response = $this->httpClient->send(
      new RequestStruct(new POST(), new HTTPBinURL('post'), null, new QueryBody([
        'test' => 'value',
      ]))
    )->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    $body = (new JSONResponseStruct($response))->json();
    self::assertEquals('https://httpbin.org/post', $body->get(['url']));
    self::assertEquals('application/x-www-form-urlencoded', $body->get(['headers', 'Content-Type']));
    self::assertEquals('value', $body->get(['form', 'test']));
  }

  /**
   * @throws \Throwable
   */
  public function testPut() {
    $response = $this->httpClient->send(
      new RequestStruct(new PUT(), new HTTPBinURL('put'), new ArraySetHeader([
        new HeaderStruct('Content-Type', 'application/json'),
      ]), new JSONBodyData([
        'test' => 'value',
      ]))
    )->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    $body = (new JSONResponseStruct($response))->json();
    self::assertEquals('https://httpbin.org/put', $body->get(['url']));
    self::assertEquals('value', $body->get(['json', 'test']));
    $response = $this->httpClient->send(
      new RequestStruct(new PUT(), new HTTPBinURL('put'), null, new QueryBody([
        'test' => 'value',
      ]))
    )->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    $body = (new JSONResponseStruct($response))->json();
    self::assertEquals('https://httpbin.org/put', $body->get(['url']));
    self::assertEquals('application/x-www-form-urlencoded', $body->get(['headers', 'Content-Type']));
    self::assertEquals('value', $body->get(['form', 'test']));
  }

  /**
   * @throws \Throwable
   */
  public function testDelete() {
    $response = $this->httpClient->send(
      new RequestStruct(new DELETE(), new HTTPBinURL('delete'))
    )->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    self::assertEquals('https://httpbin.org/delete', (new JSONResponseStruct($response))->json()->get(['url']));
  }

  /**
   * @throws \Throwable
   */
  public function testSendMany() {
    $responses = $this->httpClient->sendMany(
      new ArrayMapRequest([
        'get' => new RequestStruct(new GET(), new HTTPBinURL('get')),
        'redirect' => new RequestStruct(new GET(), new HTTPBinURL('redirect/6')),
        'post' => new RequestStruct(new POST(), new HTTPBinURL('post'), new ArraySetHeader([
          new HeaderStruct('Content-Type', 'application/json'),
        ]), new JSONBodyData([
          'test' => 'value',
        ])),
        'put' => new RequestStruct(new PUT(), new HTTPBinURL('put'), new ArraySetHeader([
          new HeaderStruct('Content-Type', 'application/json'),
        ]), new JSONBodyData([
          'test' => 'value',
        ])),
        'delete' => new RequestStruct(new DELETE(), new HTTPBinURL('delete')),
      ])
    );
    $response = $responses->get('get')->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    self::assertEquals('https://httpbin.org/get', (new JSONResponseStruct($response))->json()->get(['url']));
    $response = $responses->get('redirect')->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    self::assertEquals('https://httpbin.org/get', (new JSONResponseStruct($response))->json()->get(['url']));
    $response = $responses->get('post')->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    $body = (new JSONResponseStruct($response))->json();
    self::assertEquals('https://httpbin.org/post', $body->get(['url']));
    self::assertEquals('value', $body->get(['json', 'test']));
    $response = $responses->get('put')->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    $body = (new JSONResponseStruct($response))->json();
    self::assertEquals('https://httpbin.org/put', $body->get(['url']));
    self::assertEquals('value', $body->get(['json', 'test']));
    $response = $responses->get('delete')->response();
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    self::assertEquals('https://httpbin.org/delete', (new JSONResponseStruct($response))->json()->get(['url']));
  }

  /**
   * @throws \Throwable
   */
  public function testFailedRequest() {
    $this->expectException(\Xtuple\Util\HTTP\Client\Exception\Throwable::class);
    $this->httpClient->send(new DELETERequest(new URLComponents(['scheme' => 'http://'])))->response();
  }
}

final class HTTPBinURL
  extends AbstractBaseURL {
  /**
   * @throws Throwable
   *
   * @param string $path
   */
  public function __construct(string $path) {
    parent::__construct('https://httpbin.org', $path);
  }
}
