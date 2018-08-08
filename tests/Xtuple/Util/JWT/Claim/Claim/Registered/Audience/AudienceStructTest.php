<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Audience;

use PHPUnit\Framework\TestCase;

class AudienceStructTest
  extends TestCase {
  public function testConstructor() {
    $claim = new class (new AudienceStruct('audience'))
      extends AbstractAudience {
    };
    self::assertEquals('aud', $claim->name());
    self::assertEquals('audience', $claim->value());
    self::assertEquals('aud: audience', (string) $claim);
  }
}
