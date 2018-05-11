<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI;

use PHPUnit\Framework\TestCase;

class ServerTest
  extends TestCase {
  public function testConstructor() {
    self::assertEquals('*', (string) new Server());
  }
}
