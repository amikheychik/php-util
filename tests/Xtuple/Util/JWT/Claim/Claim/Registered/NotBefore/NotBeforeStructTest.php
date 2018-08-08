<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\NotBefore;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class NotBeforeStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $now = time();
    $claim = new class (new NotBeforeStruct(new DateTimeTimestampSeconds($now)))
      extends AbstractNotBefore {
    };
    self::assertEquals('nbf', $claim->name());
    self::assertEquals($now, $claim->value());
    self::assertEquals("nbf: {$now}", (string) $claim);
    self::assertTrue($claim->datetime()->equals(new DateTimeTimestampSeconds($now)));
  }
}
