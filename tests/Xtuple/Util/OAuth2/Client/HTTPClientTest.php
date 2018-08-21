<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client;

use PHPUnit\Framework\TestCase;
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
use Xtuple\Util\OAuth2\Client\Token\Access\AccessToken;
use Xtuple\Util\OAuth2\Client\Token\Access\AccessTokenStruct;
use Xtuple\Util\OAuth2\Client\Token\Exchange\Exchange;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;
use Xtuple\Util\Type\UUID\UUIDv4;

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
    $client = new HTTPClient(
      new TestClient(),
      new TestExchange($now)
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

final class TestExchange
  implements Exchange {
  /** @var int */
  private $now;

  public function __construct(int $now) {
    $this->now = $now;
  }

  public function token(): AccessToken {
    /** @noinspection PhpUnhandledExceptionInspection */
    return new AccessTokenStruct(
      (string) new UUIDv4(),
      'Bearer',
      new TimestampStruct($this->now),
      null
    );
  }
}
