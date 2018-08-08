<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request\Cache;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Request\Method\Method\POST;
use Xtuple\Util\HTTP\Request\RequestStruct;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequestStruct;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\JSON\AccessTokenJSONRequest;
use Xtuple\Util\OAuth2\Client\Endpoint\EndpointStruct;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

class KeyAccessTokenRequestTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $now = time();
    $key = new KeyAccessTokenRequest(
      new AccessTokenJSONRequest(
        new EndpointStruct(
          new URLString('https://example.com')
        ),
        new JSONBodyData([
          'scope' => 'example test',
        ]),
        new TimestampStruct($now)
      )
    );
    self::assertEquals([
      'https://example.com',
      sha1(base64_encode(json_encode([
        'scope' => 'example test',
      ]))),
    ], $key->fields());
  }

  /**
   * @expectedException \Xtuple\Util\Exception\Throwable
   * @expectedExceptionMessage Failed to create an access token request cache key
   * @throws \Throwable
   */
  public function testConstructorException() {
    $now = time();
    $key = new KeyAccessTokenRequest(
      new AccessTokenRequestStruct(
        new RequestStruct(
          new POST(),
          new URLString('https://example.com'),
          null,
          new class ()
            implements Body {
            private $file = '/tmp/phpunit/php-util/missing-file';

            public function resource() {
              if (file_exists($this->file)) {
                unlink($this->file);
              }
              return fopen($this->file, 'rb');
            }
          }
        ),
        new TimestampStruct($now)
      )
    );
    self::assertEquals([
      'https://example.com',
      sha1(base64_encode(json_encode(''))),
    ], $key->fields());
  }

  protected function tearDown() {
    parent::tearDown();
    if (file_exists('/tmp/phpunit/php-util/missing-file')) {
      unlink('/tmp/phpunit/php-util/missing-file');
      rmdir('/tmp/phpunit/php-util');
    }
  }
}
