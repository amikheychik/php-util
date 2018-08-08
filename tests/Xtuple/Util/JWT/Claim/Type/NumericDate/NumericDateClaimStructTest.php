<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Type\NumericDate;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class NumericDateClaimStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $now = time();
    $claim = new class (new NumericDateClaimStruct('test', new DateTimeTimestampSeconds($now)))
      extends AbstractNumericDateClaim {
    };
    self::assertEquals('test', $claim->name());
    self::assertEquals($now, $claim->value());
    self::assertEquals("test: {$now}", (string) $claim);
    self::assertTrue($claim->datetime()->equals(new DateTimeTimestampSeconds($now)));
  }
}
