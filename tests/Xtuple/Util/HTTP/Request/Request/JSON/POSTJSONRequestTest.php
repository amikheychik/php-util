<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Request\JSON;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\Type\Stream\String\StringStreamStruct;

final class POSTJSONRequestTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $request = new POSTJSONRequest(
      new URLString('http://example.com'),
      new JSONBodyData([
        'example' => 'text',
      ]),
      new ArraySetHeader([
        new HeaderStruct('Content-Length', '18'),
      ])
    );
    self::assertEquals('http://example.com', (string) $request->uri());
    self::assertEquals('POST', (string) $request->method());
    self::assertEquals(2, $request->headers()->count());
    self::assertEquals('application/json', $request->headers()->get('Content-Type')->value());
    self::assertEquals('{"example":"text"}', (string) new StringStreamStruct($request->body()));
  }
}
