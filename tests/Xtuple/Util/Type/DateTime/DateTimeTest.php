<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Message\Type\Date\DateTimeMessageStruct;

class DateTimeTest
  extends TestCase {
  /** @var int */
  private $time;
  /** @var string */
  private $date;

  protected function setUp() {
    parent::setUp();
    $this->time = time();
    $this->date = date('Y-m-d\TH:i:s', $this->time);
  }

  /**
   * @throws \Throwable
   */
  public function testStruct() {
    $dateTime = new DateTimeStruct(new \DateTimeImmutable($this->date));
    // utc() method returns time formatted UTC time in ISO 8601, while timezone() is actual timezone
    self::assertEquals(
      date(
        'Y-m-d\TH:i:s\Z',
        $this->time - (new \DateTimeZone(ini_get('date.timezone')))->getOffset(new \DateTime($this->date))
      ),
      $dateTime->utc()
    );
    $default = ini_get('date.timezone');
    ini_set('date.timezone', 'UTC');
    $serialized = serialize($dateTime);
    self::assertEquals(
      strtr('C:40:"Xtuple\Util\Type\DateTime\DateTimeStruct":20:{{date}}', [
        '{date}' => date('Y-m-d\TH:i:s\Z', $this->time),
      ]),
      $serialized
    );
    $unserialized = unserialize($serialized);
    self::assertEquals(
      date('Y-m-d\TH:i:s\Z', $this->time),
      $unserialized->utc()
    );
    self::assertEquals(
      date('Y-m-d\TH:i:s.000\Z', $this->time),
      $unserialized->jsonSerialize()
    );
    self::assertEquals(
      date('"Y-m-d\TH:i:s.000\Z"', $this->time),
      json_encode($unserialized)
    );
    ini_set('date.timezone', $default);
  }

  /**
   * @throws \Throwable
   */
  public function testStructCompare() {
    // These dates are parsed as UTC, because contain timezone in the format
    $dateTime1 = new DateTimeStruct(new \DateTimeImmutable('2018-01-01T00:00:00+00:00'));
    $dateTime2 = new DateTimeStruct(new \DateTimeImmutable('2018-01-01T00:00:00Z'));
    self::assertEquals('2018-01-01T00:00:00+00:00', (string) $dateTime1);
    self::assertEquals('2018-01-01T00:00:00+00:00', (string) $dateTime2);
    self::assertTrue($dateTime1->equals($dateTime2));
    self::assertEquals(0, $dateTime1->compare($dateTime2));
    // These dates are parsed as America/New_York
    $dateTime3 = new DateTimeStruct(new \DateTimeImmutable('2018-01-01T00:00:00 America/New_York'));
    $default = ini_get('date.timezone');
    ini_set('date.timezone', 'America/New_York');
    $dateTime4 = new DateTimeStruct(new \DateTimeImmutable('2018-01-01T00:00:00'));
    ini_set('date.timezone', $default);
    self::assertEquals('2018-01-01T05:00:00+00:00', (string) $dateTime3);
    self::assertEquals('2018-01-01T05:00:00+00:00', (string) $dateTime4);
    self::assertTrue($dateTime3->equals($dateTime4));
    // $dateTime1 < $dateTime4 (is earlier)
    self::assertEquals(-1, $dateTime1->compare($dateTime4));
    self::assertEquals(1, $dateTime4->compare($dateTime1));
    self::assertFalse($dateTime1->equals($dateTime4));
  }

  /**
   * @throws \Throwable
   */
  public function testString() {
    $default = ini_get('date.timezone');
    ini_set('date.timezone', 'America/New_York');
    $est = new DateTimeString('Jan 1, 2018');
    self::assertEquals('2018-01-01T05:00:00+00:00', (string) $est);
    $utc = new DateTimeString('Jan 1, 2018', 'UTC');
    self::assertEquals('2018-01-01T00:00:00+00:00', (string) $utc);
    $pst = new DateTimeString('Dec 31, 2017 9pm', 'America/Los_Angeles');
    self::assertEquals('2018-01-01T05:00:00+00:00', (string) $pst);
    self::assertTrue($pst->equals($est));
    $serialized = serialize($est);
    self::assertEquals(
      'C:40:"Xtuple\Util\Type\DateTime\DateTimeString":20:{2018-01-01T05:00:00Z}',
      $serialized
    );
    $unserialized = unserialize($serialized);
    self::assertTrue($est->equals($unserialized));
    self::assertEquals(
      $serialized,
      serialize($unserialized)
    );
    self::assertEquals(
      '"2018-01-01T05:00:00.000Z"',
      json_encode($est)
    );
    ini_set('date.timezone', $default);
    $pst = new DateTimeString('Jan 1, 2018 PST');
    self::assertEquals('2018-01-01T08:00:00+00:00', (string) $pst);
    // Timezone parsed from the date takes priority over specified
    $pst = new DateTimeString('Jan 1, 2018 PST', 'UTC');
    self::assertEquals('2018-01-01T08:00:00+00:00', (string) $pst);
    $utc = new DateTimeString('2018-01-01T08:00Z', 'PST');
    self::assertEquals('2018-01-01T08:00:00+00:00', (string) $utc);
    self::assertTrue($utc->equals($pst));
  }

  /**
   * @throws \Throwable
   */
  public function testDaylightSavingsTime() {
    $pst = new DateTimeString('Sunday, March 11, 2018, 2:00:00 am', 'America/Los_Angeles');
    $pdt = new DateTimeString('Sunday, March 11, 2018, 3:00:00 am', 'America/Los_Angeles');
    self::assertTrue($pst->equals($pdt));
    self::assertEquals('2018-03-11T10:00:00+00:00', (string) $pst);
    self::assertEquals('2018-03-11T10:00:00+00:00', (string) $pdt);
    $pst = new DateTimeString('Sunday, March 11, 2018, 2:30:00 am', 'America/Los_Angeles');
    self::assertEquals('2018-03-11T10:30:00+00:00', (string) $pst);
    // March 11, 2:30am time is already 3:30am, so original 3:00am is earlier
    self::assertEquals(1, $pst->compare($pdt));
    $winter = new DateTimeString('Sunday, March 25, 2018, 1:00:00 am', 'Europe/London');
    $summer = new DateTimeString('Sunday, March 25, 2018, 2:00:00 am', 'Europe/London');
    self::assertTrue($winter->equals($summer));
    self::assertEquals('2018-03-25T01:00:00+00:00', (string) $winter);
    self::assertEquals('2018-03-25T01:00:00+00:00', (string) $summer);
    $winter = new DateTimeString('Sunday, March 25, 2018, 1:30:00 am', 'Europe/London');
    self::assertEquals('2018-03-25T01:30:00+00:00', (string) $winter);
    // March 25, 1:30am time is already 2:30am
    self::assertEquals(-1, $summer->compare($winter));
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Unix timestamp must be non-negative.
   * @throws \Throwable
   */
  public function testTimestamp() {
    // Timestamp by default use timezone of the system
    $timestamp = new DateTimeTimestampSeconds($this->time);
    self::assertEquals(
      date(
        'Y-m-d\TH:i:s\Z',
        $this->time - (new \DateTimeZone(ini_get('date.timezone')))->getOffset(new \DateTime($this->date))
      ),
      $timestamp->utc()
    );
    $timestamp = new DateTimeTimestampSeconds(
      (int) (new DateTimeMessageStruct(new DateTimeString('Jan 1, 2018', 'UTC'), 'U'))->format('en_US')
    );
    self::assertEquals(
      '2018-01-01T00:00:00+00:00',
      (string) $timestamp
    );
    $timestamp = new DateTimeTimestampSeconds(
      (int) (new DateTimeMessageStruct(new DateTimeString('Jan 1, 2018', 'EST'), 'U'))->format('en_US')
    );
    self::assertEquals(
      '2018-01-01T05:00:00+00:00',
      (string) $timestamp
    );
    $timestamp = new DateTimeTimestampSeconds(0);
    self::assertEquals('1970-01-01T00:00:00+00:00', (string) $timestamp);
    $timestamp = new DateTimeTimestampSeconds((2 ** 32) / 2);
    self::assertEquals('2038-01-19T03:14:08+00:00', (string) $timestamp);
    $timestamp = new DateTimeTimestampSeconds(PHP_INT_MAX);
    self::assertEquals('6596-12-04T15:30:07+00:00', (string) $timestamp);
    new DateTimeTimestampSeconds(-1);
  }

  /**
   * @throws \Throwable
   */
  public function testDateTimeImmutable() {
    $dateTime = new \DateTimeImmutable($this->date, null);
    self::assertEquals($this->time, $dateTime->getTimestamp());
    self::assertEquals(ini_get('date.timezone'), $dateTime->getTimezone()->getName());
    $defaultTimezone = new \DateTimeZone(ini_get('date.timezone'));
    $dateTime = new \DateTimeImmutable($this->date, $defaultTimezone);
    self::assertEquals($this->time, $dateTime->getTimestamp());
    $customTimezone = new \DateTimeZone('America/Los_Angeles');
    $dateTime = new \DateTimeImmutable($this->date, $customTimezone);
    /** @var \DateTime $dateTime */
    self::assertEquals(
      $this->time + ($defaultTimezone->getOffset($dateTime) - $customTimezone->getOffset($dateTime)),
      $dateTime->getTimestamp()
    );
    $utcTimezone = new \DateTimeZone('UTC');
    self::assertEquals('UTC', $utcTimezone->getName());
    self::assertEquals(0, $utcTimezone->getOffset($dateTime));
  }
}
