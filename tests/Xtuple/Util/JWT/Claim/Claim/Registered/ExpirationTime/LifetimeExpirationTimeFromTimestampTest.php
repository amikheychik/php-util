<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\ExpirationTime;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

class LifetimeExpirationTimeFromTimestampTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $claim = new LifetimeExpirationTimeFromTimestamp(
      new TimestampStruct(1534178452),
      3600
    );
    self::assertEquals('1534182052', $claim->value());
    self::assertEquals('exp', $claim->name());
    self::assertEquals('exp: 1534182052', (string) $claim);
    self::assertTrue($claim->datetime()->equals(new DateTimeTimestampSeconds(1534182052)));
  }
}
