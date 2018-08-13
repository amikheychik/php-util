<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Client\Client;
use Xtuple\Util\HTTP\Client\Test\TestClient;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\Request\JSON\POSTJSONRequest;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequest;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequestStruct;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\JSON\AccessTokenJSONRequest;
use Xtuple\Util\OAuth2\Client\Endpoint\EndpointStruct;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;
use Xtuple\Util\Type\UUID\UUID;
use Xtuple\Util\Type\UUID\UUIDv4;

class FreshAccessTokenTest
  extends TestCase {
  /** @var Client */
  private $http;
  /** @var int */
  private $now;
  /** @var UUID */
  private $uuid;
  /** @var AccessTokenRequest */
  private $request;

  /**
   * @throws \Throwable
   */
  protected function setUp() {
    parent::setUp();
    $this->http = new TestClient();
    $this->now = time();
    $this->uuid = new UUIDv4();
    $this->request = new AccessTokenJSONRequest(
      new EndpointStruct(
        new URLString('https://example.com/token')
      ),
      new JSONBodyData([
        'access_token' => (string) $this->uuid,
        'token_type' => 'bearer',
        'expires_in' => 3600,
      ]),
      new TimestampStruct($this->now)
    );
  }

  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $token = new FreshAccessToken($this->http, $this->request);
    self::assertEquals('bearer', $token->type());
    self::assertEquals((string) $this->uuid, $token->value());
    self::assertEquals($this->now + 3600, $token->expiresAt()->seconds());
  }

  /**
   * @expectedException \Xtuple\Util\Exception\Throwable
   * @expectedExceptionMessage Failed to retrieve a fresh access token
   * @throws \Throwable
   */
  public function testConstructorException() {
    $request = new AccessTokenRequestStruct(
      new POSTJSONRequest(
        new URLString('https://example.com/token'),
        new JSONBodyData([
          'access_token' => (string) $this->uuid,
          'token_type' => 'bearer',
          'expires_in' => 3600,
        ]),
        new ArraySetHeader([
          new HeaderStruct('Response-Code', (string) 404),
          new HeaderStruct('Response-Reason', 'Not found'),
        ])
      ),
      new TimestampStruct($this->now)
    );
    new FreshAccessToken($this->http, $request);
  }
}