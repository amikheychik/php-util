<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Date;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\DateTime\DateTimeString;

class DateTimeMessageTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testStruct() {
    $default = ini_get('date.timezone');
    ini_set('date.timezone', 'America/New_York');
    $message = new DateTimeMessageStruct(
      new DateTimeString('2018-01-01T00:00:00Z'),
      'm/d/Y g:ia'
    );
    self::assertEquals('01/01/2018 12:00am', (string) $message);
    self::assertEquals('01/01/2018 12:00am', $message->format('ru_RU'));
    self::assertEquals('12/31/2017 7:00pm', $message->timezone());
    self::assertEquals('12/31/2017 4:00pm', $message->timezone('America/Los_Angeles'));
    ini_set('date.timezone', $default);
    self::assertEquals('m/d/Y g:ia', $message->template());
    self::assertEquals(0, $message->arguments()->count());
  }

  /**
   * @throws \Throwable
   */
  public function testArgument() {
    $argument = new DateTimeArgumentStruct('date', new DateTimeMessageStruct(
      new DateTimeString('Sunday, March 11, 2018, 2:00:00 am', 'America/Chicago'),
      'c'
    ));
    self::assertEquals('2018-03-11T08:00:00+00:00', (string) $argument);
    self::assertEquals('2018-03-11T00:00:00-08:00', $argument->timezone('America/Los_Angeles'));
    self::assertEquals('date', $argument->key());
    self::assertEquals('c', $argument->template());
  }
}
