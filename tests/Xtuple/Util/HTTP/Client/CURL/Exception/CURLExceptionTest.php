<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Exception;

use PHPUnit\Framework\TestCase;

final class CURLExceptionTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $resource = curl_init();
    $exception = new CURLException($resource);
    self::assertEquals('cURL error: [0] No error', $exception->getMessage());
    curl_close($resource);
    $resource = curl_init('http://');
    curl_exec($resource);
    $exception = new CURLException($resource);
    self::assertEquals("cURL error: [6] Couldn't resolve host name", $exception->getMessage());
  }
}
