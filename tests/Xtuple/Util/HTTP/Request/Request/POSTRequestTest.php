<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Request;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\Header\ContentType\JSONContentTypeHeader;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\Type\Stream\String\StringStreamStruct;

final class POSTRequestTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $request = new POSTRequest(
      new URLString('http://example.com'),
      new ArraySetHeader([
        new JSONContentTypeHeader(),
      ]),
      new JSONBodyData([
        'example' => 'text',
      ])
    );
    self::assertEquals('http://example.com', (string) $request->uri());
    self::assertEquals('POST', (string) $request->method());
    self::assertEquals(1, $request->headers()->count());
    self::assertEquals('application/json', $request->headers()->get('Content-Type')->value());
    self::assertEquals('{"example":"text"}', (string) new StringStreamStruct($request->body()));
  }
}
