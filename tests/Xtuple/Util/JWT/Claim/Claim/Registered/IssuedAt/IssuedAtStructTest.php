<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class IssuedAtStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $now = time();
    $claim = new class (new IssuedAtStruct(new DateTimeTimestampSeconds($now)))
      extends AbstractIssuedAt {
    };
    self::assertEquals('iat', $claim->name());
    self::assertEquals($now, $claim->value());
    self::assertEquals("iat: {$now}", (string) $claim);
    self::assertTrue($claim->datetime()->equals(new DateTimeTimestampSeconds($now)));
  }
}
