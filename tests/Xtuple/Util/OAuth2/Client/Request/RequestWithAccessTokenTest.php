<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Request;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;
use Xtuple\Util\HTTP\Request\Request\JSON\POSTJSONRequest;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\OAuth2\Client\Token\Access\AccessTokenStruct;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;
use Xtuple\Util\Type\UUID\UUIDv4;

class RequestWithAccessTokenTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $uuid = new UUIDv4();
    $now = time();
    $request = new RequestWithAccessToken(
      new POSTJSONRequest(
        new URLString('https://example.com'),
        new JSONBodyData([
          'scope' => 'example scope',
        ])
      ),
      new AccessTokenStruct(
        (string) $uuid,
        'Bearer',
        new TimestampStruct($now),
        null
      )
    );
    self::assertEquals('POST', (string) $request->method());
    self::assertEquals('https://example.com', (string) $request->uri());
    self::assertEquals('{"scope":"example scope"}', (new StringBodyFromBody($request->body()))->content());
    $header = $request->headers()->get('Authorization');
    self::assertEquals('Authorization', $header->name());
    self::assertEquals("Bearer {$uuid}", $header->value());
    self::assertEquals("Authorization: Bearer {$uuid}", (string) $header);
  }
}
