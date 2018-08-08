<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Issuer;

use PHPUnit\Framework\TestCase;

class IssuerStructTest
  extends TestCase {
  public function testConstructor() {
    $claim = new class (new IssuerStruct('issuer'))
      extends AbstractIssuer {
    };
    self::assertEquals('iss', $claim->name());
    self::assertEquals('issuer', $claim->value());
    self::assertEquals('iss: issuer', (string) $claim);
  }
}
