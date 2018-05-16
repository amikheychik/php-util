<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\BodyStream;
use Xtuple\Util\HTTP\Message\Body\String\JSON\Exception\JSONThrowable;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;

class JSONBodyFromStringBodyTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testStruct() {
    $stream = tmpfile();
    fwrite($stream, json_encode(['test' => 'stream']));
    $body = new BodyStream($stream);
    $json = new JSONBodyFromStringBody(new StringBodyFromBody($body));
    self::assertEquals('stream', $json->data()->get(['test']));
    fseek($body->resource(), 0);
    self::assertEquals('{"test":"stream"}', stream_get_contents($body->resource()));
    self::assertEquals(['test' => 'stream'], $json->jsonSerialize());
    self::assertEquals('stream', $json->data()->get(['test']));
  }

  /**
   * @throws \Throwable
   */
  public function testDecodeException() {
    $stream = tmpfile();
    fwrite($stream, '{broken:"json"}');
    $body = new BodyStream($stream);
    $json = new JSONBodyFromStringBody(new StringBodyFromBody($body));
    $this->expectException(JSONThrowable::class);
    $json->data();
  }
}
