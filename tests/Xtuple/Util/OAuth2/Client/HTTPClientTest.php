<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Cache\Cache\Memory\MemoryCache;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\HTTP\Client\Test\TestClient;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\Collection\Map\ArrayMapRequest;
use Xtuple\Util\HTTP\Request\Method\Method\POST;
use Xtuple\Util\HTTP\Request\Request\JSON\POSTJSONRequest;
use Xtuple\Util\HTTP\Request\RequestStruct;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequestStruct;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

class HTTPClientTest
  extends TestCase {
  /** @var Client */
  private $oauth2;

  /**
   * @throws \Throwable
   */
  protected function setUp() {
    parent::setUp();
    $now = time();
    $request = new AccessTokenRequestStruct(
      new POSTJSONRequest(
        new URLString('https://example.com'),
        new JSONBodyData([
          'scope' => 'example scope',
        ]),
        new ArraySetHeader([
          new HeaderStruct('Content-Length', (string) 25),
        ])
      ),
      new TimestampStruct($now),
      new KeyStruct([
        'https://example.com',
        'example scope',
      ])
    );
    $client = new HTTPClient(
      new TestClient(),
      new MemoryCache('oauth2'),
      $request
    );
    $this->oauth2 = new class ($client)
      extends AbstractClient {
    };
  }

  /**
   * @throws \Throwable
   */
  public function testClient() {
    $result = $this->oauth2->sendMany(new ArrayMapRequest([
      new POSTJSONRequest(
        new URLString('http://example.com'),
        new JSONBodyData([
          'test' => 'Example',
        ])
      ),
    ]))->get('0');
    self::assertEquals('{"test":"Example"}', (string) new StringBodyFromBody($result->response()->body()));
  }

  /**
   * @expectedException \Xtuple\Util\Exception\Throwable
   * @expectedExceptionMessage Failed OAuth2 HTTP request
   * @throws \Throwable
   */
  public function testException() {
    $this->oauth2->send(new RequestStruct(
      new POST(),
      new URLString('https://example.com'),
      new ArraySetHeader([
        new HeaderStruct('Response-Error', 'Exception test'),
      ]),
      null
    ))->response();
  }
}
