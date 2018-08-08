<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Type;

use PHPUnit\Framework\TestCase;

class JWTTypeTest
  extends TestCase {
  public function testConstructor() {
    $claim = new JWTType();
    self::assertEquals('typ', $claim->name());
    self::assertEquals('JWT', $claim->value());
    self::assertEquals('typ: JWT', (string) $claim);
  }
}
