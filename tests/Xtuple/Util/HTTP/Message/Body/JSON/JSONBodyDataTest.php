<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\String\JSON\Exception\JSONThrowable;
use Xtuple\Util\Type\Stream\String\StringStreamFromResource;

final class JSONBodyDataTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testJSON() {
    $body = new JSONBodyData([
      'integer' => 1,
      'null' => null,
      'string' => 'content',
    ]);
    $expected = '{"integer":1,"null":null,"string":"content"}';
    self::assertEquals($expected, (string) $body);
    self::assertEquals($expected, json_encode($body));
    self::assertEquals($expected, $body->content());
    self::assertEquals($expected, new StringStreamFromResource($body->resource()));
    self::assertEquals(1, $body->data()->get(['integer']));
  }

  /**
   * @throws \Throwable
   */
  public function testJSONException() {
    $body = new JSONBodyData([tmpfile()]);
    self::assertEquals('', (string) $body);
    self::assertFalse(json_encode($body));
    $this->expectException(JSONThrowable::class);
    $body->content();
  }
}
