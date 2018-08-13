<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation\Path;

use PHPUnit\Framework\TestCase;

class PathStructTest
  extends TestCase {
  public function testJSONEncoding() {
    $path = new PathStruct('/a/b/c');
    self::assertEquals('/a/b/c', $path->value());
    self::assertEquals('"\/a\/b\/c"', json_encode($path));
  }
}
