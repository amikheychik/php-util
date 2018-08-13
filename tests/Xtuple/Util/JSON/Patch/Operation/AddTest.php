<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\JSON\Patch\Operation\Path\PathForKey;

class AddTest
  extends TestCase {
  public function testJSONEncoding() {
    $add = new Add(new PathForKey('code', 'country'), 'US');
    self::assertEquals('{"op":"add","path":"\/country\/code","value":"US"}', json_encode($add));
  }
}
