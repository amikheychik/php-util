<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime\Timestamp;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeTimestamp;

class TimestampTest
  extends TestCase {
  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage Unix timestamp must be non-negative.
   */
  public function testStruct() {
    $time = time();
    $timestamp = new TimestampStruct($time);
    self::assertEquals($time, $timestamp->seconds());
    new TimestampStruct(-1);
  }

  public function testDateTime() {
    $time = time();
    $date = new DateTimeTimestamp($time);
    $timestamp = new TimestampDateTime($date);
    self::assertEquals($time, $timestamp->seconds());
    self::assertEquals(
      0,
      (new TimestampDateTime(new DateTimeTimestamp(0)))->seconds()
    );
  }
}
