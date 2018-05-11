<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\Stream\String\StringStreamFromResource;

final class StringBodyFromStringTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testBody() {
    $body = new StringBodyFromString('Test content');
    self::assertEquals('Test content', (string) $body);
    self::assertEquals('Test content', $body->content());
    self::assertEquals('Test content', new StringStreamFromResource($body->resource()));
  }
}
