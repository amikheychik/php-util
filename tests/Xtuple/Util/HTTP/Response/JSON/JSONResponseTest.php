<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\JSON;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Response\ResponseStruct;
use Xtuple\Util\HTTP\Response\Status\StatusString;

final class JSONResponseTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $response = new TestJSONResponse(new JSONResponseStruct(
      new ResponseStruct(
        new StatusString('HTTP/1.1 200 OK'),
        new ArraySetHeader([
          new HeaderStruct('Content-Type', 'application/json'),
        ]),
        new JSONBodyData([
          'test' => 'example',
        ])
      )
    ));
    self::assertEquals('1.1', $response->status()->version());
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals(1, $response->headers()->count());
    self::assertEquals('application/json', $response->headers()->get('Content-Type')->value());
    self::assertEquals([
      'test' => 'example',
    ], $response->json()->data());
  }
}

final class TestJSONResponse
  extends AbstractJSONResponse {
}
