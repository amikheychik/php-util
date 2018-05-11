<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Collection\Map;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Client\CURL\Configuration\DebugConfiguration;
use Xtuple\Util\HTTP\Client\CURL\Handle\BinaryHandle;
use Xtuple\Util\HTTP\Request\Request\GETRequest;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;

final class ArrayMapHandleTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testGetByResource() {
    $handle = new BinaryHandle(
      'get',
      new GETRequest(new URLString('http://httpbin.org/image/png')),
      new DebugConfiguration()
    );
    $handles = new ArrayMapHandle([$handle]);
    self::assertTrue($handles->getByResource($handle->handle()) === $handle);
    $new = curl_init();
    self::assertNull($handles->getByResource($new));
  }
}
