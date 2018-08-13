<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Collection\Map;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Request\Request\GETRequest;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;

class ArrayMapRequestTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $map = new class (new ArrayMapRequest())
      extends AbstractMapRequest {
    };
    self::assertTrue($map->isEmpty());
    self::assertEquals(0, $map->count());
    /** @var MapRequest $map */
    $map = new class (new ArrayMapRequest([
      new GETRequest(
        new URLString('http://example.com')
      ),
    ]))
      extends AbstractMapRequest {
    };
    self::assertFalse($map->isEmpty());
    self::assertEquals(1, $map->count());
    self::assertEquals('http://example.com', $map->get('0')->uri());
    /** @var MapRequest $map */
    $map = new class (new ArrayMapRequest([
      'example' => new GETRequest(
        new URLString('http://example.com')
      ),
    ]))
      extends AbstractMapRequest {
    };
    self::assertFalse($map->isEmpty());
    self::assertEquals(1, $map->count());
    self::assertEquals('http://example.com', $map->get('example')->uri());
  }
}
