<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime\Timestamp;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class TimestampTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Unix timestamp must be non-negative.
   */
  public function testStruct() {
    $time = time();
    $timestamp = new TimestampStruct($time);
    self::assertEquals($time, $timestamp->seconds());
    new TimestampStruct(-1);
  }

  /**
   * @throws \Throwable
   */
  public function testDateTime() {
    $time = time();
    $date = new DateTimeTimestampSeconds($time);
    $timestamp = new TimestampDateTime($date);
    self::assertEquals($time, $timestamp->seconds());
    self::assertEquals(
      0,
      (new TimestampDateTime(new DateTimeTimestampSeconds(0)))->seconds()
    );
  }
}
