<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\JWTID;

use PHPUnit\Framework\TestCase;

class JWTIDStructTest
  extends TestCase {
  public function testConstructor() {
    $claim = new class (new JWTIDStruct('jwt_id'))
      extends AbstractJWTID {
    };
    self::assertEquals('jti', $claim->name());
    self::assertEquals('jwt_id', $claim->value());
    self::assertEquals('jti: jwt_id', (string) $claim);
  }
}
