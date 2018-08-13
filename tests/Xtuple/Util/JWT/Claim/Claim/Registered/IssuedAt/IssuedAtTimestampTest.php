<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

class IssuedAtTimestampTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $claim = new IssuedAtTimestamp(new TimestampStruct(1534178452));
    self::assertEquals('1534178452', $claim->value());
    self::assertEquals('iat', $claim->name());
    self::assertEquals('iat: 1534178452', (string) $claim);
    self::assertTrue($claim->datetime()->equals(new DateTimeTimestampSeconds(1534178452)));
  }
}
