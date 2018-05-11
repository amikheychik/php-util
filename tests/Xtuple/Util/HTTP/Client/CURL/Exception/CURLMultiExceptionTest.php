<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Exception;

use PHPUnit\Framework\TestCase;

final class CURLMultiExceptionTest
  extends TestCase {
  public function testConstructor() {
    $exception = new CURLMultiException();
    self::assertEquals('cURL multi error: [0] No error', $exception->getMessage());
    $exception = new CURLMultiException(1);
    self::assertEquals('cURL multi error: [1] Invalid multi handle', $exception->getMessage());
  }
}
