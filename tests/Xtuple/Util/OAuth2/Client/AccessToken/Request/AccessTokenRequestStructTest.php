<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\Request\JSON\POSTJSONRequest;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

class AccessTokenRequestStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $now = time();
    $request = new TestAccessTokenRequest(
      new AccessTokenRequestStruct(
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
          'example test',
        ])
      )
    );
    $content = '{"scope":"example scope"}';
    self::assertEquals('POST', (string) $request->method());
    self::assertEquals('https://example.com', (string) $request->uri());
    self::assertEquals($content, (new StringBodyFromBody($request->body()))->content());
    self::assertEquals(
      strlen($content),
      $request->headers()->get('Content-Length')->value()
    );
    self::assertEquals($now, $request->issuedAt()->seconds());
    self::assertEquals([
      'https://example.com',
      'example test',
    ], $request->key()->fields());
  }
}

final class TestAccessTokenRequest
  extends AbstractAccessTokenRequest {
}
