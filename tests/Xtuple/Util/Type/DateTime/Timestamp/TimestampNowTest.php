<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime\Timestamp;

use PHPUnit\Framework\TestCase;

class TimestampNowTest
  extends TestCase {
  public function testConstructor() {
    $now = time();
    $timestamp = new TimestampNow();
    self::assertGreaterThanOrEqual($now, $timestamp->seconds());
    $now = time();
    self::assertGreaterThanOrEqual($timestamp->seconds(), $now);
  }
}
