<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Endpoint;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;

class EndpointStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $endpoint = new class (new EndpointStruct(new URLString('https://example.com/token')))
      extends AbstractEndpoint {
    };
    self::assertEquals('https://example.com/token', (string) $endpoint->token());
  }
}
