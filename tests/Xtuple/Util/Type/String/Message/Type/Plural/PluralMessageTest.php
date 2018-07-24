<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Plural;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Message\AbstractMessage;
use Xtuple\Util\Type\String\Message\Type\Number\Currency\CurrencyMessageStruct;
use Xtuple\Util\Type\String\Message\Type\Number\Float\FloatArgument;
use Xtuple\Util\Type\String\Message\Type\Number\Float\FloatMessage;
use Xtuple\Util\Type\String\Message\Type\Number\Integer\IntegerMessage;
use Xtuple\Util\Type\String\Message\Type\Number\NumberMessage;
use Xtuple\Util\Type\String\Message\Type\Number\Percent\PercentMessage;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

class PluralMessageTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testStruct() {
    $count = new FloatMessage(3);
    $plural = new StringMessage('{count} items');
    $singular = new StringMessage('One item');
    $plurals = new ArrayMapArgument([
      new StringArgument('few', '{count} items'),
    ]);
    $arguments = new ArrayMapArgument();
    $message = new PluralMessageStruct($count, $plural, $singular, $plurals, $arguments, 1.0);
    self::assertEquals('{count} items', $message->template());
    self::assertEquals($count, $message->count());
    self::assertEquals($plural, $message->plural());
    self::assertEquals($singular, $message->singular());
    self::assertEquals($plurals, $message->plurals());
    self::assertEquals(1.0, $message->offset());
    $message = new PluralMessageStruct($count, $plural, null);
    self::assertEquals('{count} items', $message->template());
    self::assertEquals($count, $message->count());
    self::assertEquals($plural, $message->plural());
    self::assertNull($message->singular());
    self::assertTrue($message->plurals()->isEmpty());
    self::assertTrue($message->arguments()->isEmpty());
    self::assertNull($message->offset());
  }

  public function testInteger() {
    $count = new IntegerMessage(0);
    $plural = new TestMessageEn($count);
    self::assertEquals('0 dollars', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('0 долларов', $plural->format('ru_RU'));
    $count = new IntegerMessage(1);
    $plural = new TestMessageEn($count);
    self::assertEquals('1 dollar', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('1 доллар', $plural->format('ru_RU'));
    $count = new IntegerMessage(2);
    $plural = new TestMessageEn($count);
    self::assertEquals('2 dollars', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('2 доллара', $plural->format('ru_RU'));
  }

  public function testFloat() {
    $count = new FloatMessage(3.1415);
    $plural = new TestMessageEn($count);
    self::assertEquals('3.142 dollars', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('3,142 долларов', $plural->format('ru_RU'));
    $count = new FloatMessage(3.1415, '#.000#');
    $plural = new TestMessageEn($count);
    self::assertEquals('3.1415 dollars', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('3,1415 долларов', $plural->format('ru_RU'));
  }

  public function testPercentage() {
    $count = new PercentMessage(0.01);
    $plural = new TestMessageEn($count);
    self::assertEquals('1% dollars', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('1 % долларов', $plural->format('ru_RU'));
    $count = new PercentMessage(1);
    $plural = new TestMessageEn($count);
    self::assertEquals('1 dollar', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('1 доллар', $plural->format('ru_RU'));
  }

  public function testCurrency() {
    $count = new CurrencyMessageStruct(3.1415, 'USD');
    $plural = new TestMessageEn($count);
    self::assertEquals('$3.14 dollars', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('3,14 $ долларов', $plural->format('ru_RU'));
    $count = new CurrencyMessageStruct(2.7182, 'USD');
    $plural = new TestMessageEn($count);
    self::assertEquals('$2.72 dollars', $plural->__toString());
    $plural = new TestMessageRu($count);
    self::assertEquals('2,72 $ долларов', $plural->format('ru_RU'));
  }

  public function testOffset() {
    $plural = new TestOffsetEn(0);
    self::assertEquals('No weight', $plural->__toString());
    $plural = new TestOffsetEn(1);
    self::assertEquals('One pound, no ounces', $plural->__toString());
    $plural = new TestOffsetEn(1.5);
    self::assertEquals('One and a half pounds and no ounces', $plural->__toString());
    $plural = new TestOffsetEn(2);
    self::assertEquals('One and a half pounds and eight ounces', $plural->__toString());
    $plural = new TestOffsetEn(2.5);
    self::assertEquals('One and a half pounds and sixteen ounces', $plural->__toString());
    $plural = new TestOffsetEn(3);
    self::assertEquals('One and a half pounds and 1.5 pounds', $plural->__toString());
    $plural = new TestOffsetEn(4);
    self::assertEquals('One and a half pounds and 2.5 pounds', $plural->__toString());
  }

  /**
   * @throws \Throwable
   */
  public function testArguments() {
    $plural = new PluralMessageStruct(
      new IntegerMessage(4321),
      new StringMessage('{count} users are {status}'),
      new StringMessage('One user is {status}'),
      null,
      new ArrayMapArgument([
        new StringArgument('status', 'online'),
      ])
    );
    self::assertEquals('4,321 users are online', $plural->__toString());
  }

  public function testStringMessage() {
    $plural = new PluralMessageFromStrings(0, '{count} items', 'One item', [
      '=0' => 'No items',
    ]);
    self::assertEquals('No items', $plural->__toString());
    $plural = new PluralMessageFromStrings(1, '{count} items', 'One item', [
      '=0' => 'No items',
    ]);
    self::assertEquals('One item', $plural->__toString());
    $plural = new PluralMessageFromStrings(2, '{count} items', 'One item', [
      '=0' => 'No items',
    ]);
    self::assertEquals('2 items', $plural->__toString());
  }

  /**
   * @throws \Throwable
   */
  public function testStringMessageOffset() {
    $offset = 1.0;
    $plural = new PluralMessageFromStrings(2, '{count} items', 'One item', [
      '=0' => 'No items',
    ], null, $offset);
    self::assertEquals('One item', $plural->__toString());
    $plural = new PluralMessageFromStrings(3, '{count} items', 'One item', [
      '=0' => 'No items',
    ], null, $offset);
    self::assertEquals('2 items', $plural->__toString());
    $plural = new PluralMessageFromStrings(3.5, '{count} items', 'One item', [
      '=0' => 'No items',
    ], new ArrayMapArgument([
      new FloatArgument('offset', 3.5 - $offset, '#000.#'),
    ]), $offset);
    self::assertEquals('002.5 items', $plural->__toString());
    $plural = new PluralArgumentFromStrings('quantity', 3.5, '{count} items', 'One item', [
      '=0' => 'No items',
    ], new ArrayMapArgument([
      new FloatArgument('offset', 3.5 - $offset, '#.00#'),
    ]), $offset);
    self::assertEquals('2.50 items', $plural->__toString());
    self::assertEquals('{count} items', $plural->template());
    self::assertEquals('3.5', $plural->count()->template());
    self::assertEquals('{count} items', $plural->plural()->template());
    self::assertEquals('One item', $plural->singular()->template());
    self::assertEquals('No items', $plural->plurals()->get('=0')->template());
    self::assertEquals(1.0, $plural->offset());
  }
}

final class TestOffsetEn
  extends AbstractMessage {
  public function __construct(float $count) {
    $offset = 1.5;
    /** @noinspection PhpUnhandledExceptionInspection - arguments type is checked */
    parent::__construct(new PluralMessageStruct(
      new FloatMessage($count),
      new StringMessage('One and a half pounds and {count} pounds'),
      new StringMessage('One pound'),
      new ArrayMapArgument([
        new StringArgument('=0', 'No weight'),
        new StringArgument('=1', 'One pound, no ounces'),
        new StringArgument('=1.5', 'One and a half pounds and no ounces'),
        new StringArgument('=2', 'One and a half pounds and eight ounces'),
        new StringArgument('=2.5', 'One and a half pounds and sixteen ounces'),
      ]),
      new ArrayMapArgument([
        new FloatArgument('offset', $count - $offset),
      ]),
      $offset
    ));
  }
}

final class TestMessageEn
  extends AbstractMessage {
  public function __construct(NumberMessage $count) {
    parent::__construct(new PluralMessageStruct(
      $count,
      new StringMessage('{count} dollars'),
      new StringMessage('1 dollar')
    ));
  }
}

final class TestMessageRu
  extends AbstractMessage {
  public function __construct(NumberMessage $count) {
    /** @noinspection PhpUnhandledExceptionInspection - arguments type is checked */
    parent::__construct(new PluralMessageStruct(
      $count,
      new StringMessage('{count} долларов'),
      new StringMessage('1 доллар'),
      new ArrayMapArgument([
        new StringArgument('few', '{count} доллара'),
      ])
    ));
  }
}
