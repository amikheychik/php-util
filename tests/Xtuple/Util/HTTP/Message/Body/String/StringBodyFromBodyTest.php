<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\BodyStream;
use Xtuple\Util\Type\Stream\Exception\Throwable;

final class StringBodyFromBodyTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $stream = tmpfile();
    fwrite($stream, 'Test content');
    $body = new StringBodyFromBody(new BodyStream($stream));
    self::assertSame($body->resource(), $stream);
    self::assertEquals('Test content', (string) $body);
    self::assertEquals('Test content', $body->content());
  }

  /**
   * @throws \Throwable
   */
  public function testSeekException() {
    $stream = tmpfile();
    error_reporting(E_ERROR);
    fwrite($stream, 'Test content');
    $body = new StringBodyFromBody(new BodyStream($stream));
    fclose($stream);
    self::assertEquals('', (string) $body);
    $this->expectException(Throwable::class);
    self::assertEquals('Test content', $body->content());
  }
}
