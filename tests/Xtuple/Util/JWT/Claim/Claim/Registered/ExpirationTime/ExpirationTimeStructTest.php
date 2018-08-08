<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\ExpirationTime;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class ExpirationTimeStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $now = time();
    $claim = new class (new ExpirationTimeStruct(new DateTimeTimestampSeconds($now)))
      extends AbstractExpirationTime {
    };
    self::assertEquals('exp', $claim->name());
    self::assertEquals($now, $claim->value());
    self::assertEquals("exp: {$now}", (string) $claim);
    self::assertTrue($claim->datetime()->equals(new DateTimeTimestampSeconds($now)));
  }
}
