<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request\JSON;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\BodyStream;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\OAuth2\Client\Endpoint\EndpointStruct;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

class AccessTokenJSONRequestTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $now = time();
    $request = new AccessTokenJSONRequest(
      new EndpointStruct(
        new URLString('https://example.com')
      ),
      new JSONBodyData([
        'scope' => 'example test',
      ]),
      new TimestampStruct($now)
    );
    self::assertEquals('POST', (string) $request->method());
    self::assertEquals('https://example.com', (string) $request->uri());
    self::assertEquals('application/json', $request->headers()->get('Content-Type')->value());
    self::assertEquals(
      '{"scope":"example test"}',
      new StringBodyFromBody(new BodyStream($request->body()->resource()))
    );
    self::assertEquals($now, $request->issuedAt()->seconds());
  }
}
