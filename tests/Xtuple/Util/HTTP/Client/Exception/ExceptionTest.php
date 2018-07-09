<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Exception;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ArrayListMessage;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

final class ExceptionTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $previous = new \Xtuple\Util\Exception\Exception('Previous');
    $exception = new Exception('Exception: {message}', [
      'message' => 'test',
    ], $previous, new ArrayListMessage([
      new StringMessage('Error message'),
    ]), 1);
    self::assertEquals('Exception: test', $exception->getMessage());
    self::assertSame($exception->getPrevious(), $previous);
    self::assertEquals('Error message', (string) $exception->errors()->get(0));
    self::assertEquals(1, $exception->getCode());
  }
}
