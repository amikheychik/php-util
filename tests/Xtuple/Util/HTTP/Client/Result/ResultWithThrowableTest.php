<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Result;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Exception;

final class ResultWithThrowableTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $response = new Exception('Test');
    $result = new ResultWithThrowable('test', $response);
    self::assertEquals('test', $result->key());
    $this->expectException(Exception::class);
    $result->response();
  }
}
