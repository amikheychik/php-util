<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Type\Stream\AbstractStream;

final class BodyStreamTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $stream = tmpfile();
    $body = new TestBodyStream(new BodyStream($stream));
    self::assertTrue($stream === $body->resource());
  }

  /**
   * @throws \Throwable
   */
  public function testTypeException() {
    $this->expectException(TypeThrowable::class);
    $this->expectExceptionMessage('Value must be of the type resource, instance of string given');
    /** @noinspection PhpParamsInspection - causing exception for test */
    new BodyStream('');
  }
}

final class TestBodyStream
  extends AbstractStream {
}
