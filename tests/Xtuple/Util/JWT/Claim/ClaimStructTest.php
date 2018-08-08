<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim;

use PHPUnit\Framework\TestCase;

class ClaimStructTest
  extends TestCase {
  public function testConstructor() {
    $claim = new class (new ClaimStruct('prn', 'Test'))
      extends AbstractClaim {
    };
    self::assertEquals('prn', $claim->name());
    self::assertEquals('Test', $claim->value());
    self::assertEquals('prn: Test', (string) $claim);
  }
}
