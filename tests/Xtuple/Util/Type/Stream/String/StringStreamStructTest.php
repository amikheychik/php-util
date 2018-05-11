<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream\String;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\Stream\Exception\Throwable;
use Xtuple\Util\Type\Stream\StreamStruct;

final class StringStreamStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $resource = tmpfile();
    fwrite($resource, 'test');
    $stream = new StringStreamStruct(new StreamStruct($resource));
    self::assertEquals('test', (string) $stream);
    self::assertEquals('test', $stream->content());
    self::assertTrue($stream->resource() === $resource);
  }

  /**
   * @throws \Throwable
   */
  public function testException() {
    $resource = tmpfile();
    fwrite($resource, 'test');
    $stream = new StringStreamStruct(new StreamStruct($resource));
    fclose($resource);
    error_reporting(E_ERROR);
    self::assertEquals('', (string) $stream);
    $this->expectException(Throwable::class);
    $stream->content();
  }
}
