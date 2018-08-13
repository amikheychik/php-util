<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation\Path;

use PHPUnit\Framework\TestCase;

class PathForKeyTest
  extends TestCase {
  public function testJSONEncoding() {
    $path = new PathForKey('c', null);
    self::assertEquals('/c', $path->value());
    self::assertEquals('"\/c"', json_encode($path));
    $path = new PathForKey('c', 'a/b');
    self::assertEquals('/a/b/c', $path->value());
    self::assertEquals('"\/a\/b\/c"', json_encode($path));
  }
}
