<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Key;

use PHPUnit\Framework\TestCase;

class KeyTest
  extends TestCase {
  public function testConstructor() {
    $key = new TestKey(new KeyStruct(['system', 'user']));
    self::assertEquals(['system', 'user'], $key->fields());
  }
}

final class TestKey
  extends AbstractKey {
}
