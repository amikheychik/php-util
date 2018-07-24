<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Message\Type\Number\Currency\CurrencyArgument;
use Xtuple\Util\Type\String\Message\Type\Number\Currency\CurrencyArgumentWithPrecision;
use Xtuple\Util\Type\String\Message\Type\Number\Currency\CurrencyMessageStruct;
use Xtuple\Util\Type\String\Message\Type\Number\Currency\CurrencyMessageWithPrecision;
use Xtuple\Util\Type\String\Message\Type\Number\Float\FloatArgument;
use Xtuple\Util\Type\String\Message\Type\Number\Integer\IntegerArgument;
use Xtuple\Util\Type\String\Message\Type\Number\Integer\IntegerMessage;
use Xtuple\Util\Type\String\Message\Type\Number\Percent\PercentArgument;
use Xtuple\Util\Type\String\Message\Type\Number\Percent\PercentMessage;

class NumberMessageTest
  extends TestCase {
  public function testCurrency() {
    $argument = new CurrencyMessageStruct(5000, 'USD');
    self::assertEquals('5000', $argument->template());
    self::assertEquals('$5,000.00', (string) $argument);
    self::assertEquals('5 000,00 $', $argument->format('ru_RU')); // 5&nbsp;000,00&nbsp;$
    $argument = new CurrencyMessageStruct(5432.10, 'USD');
    self::assertEquals('5432.1', $argument->template());
    self::assertEquals('$5,432.10', (string) $argument);
    $argument = new CurrencyMessageStruct(-5432.10, 'USD');
    self::assertEquals('-5432.1', $argument->template());
    self::assertEquals('-$5,432.10', (string) $argument);
    $argument = new CurrencyMessageStruct(5432.1024, 'USD');
    self::assertEquals('5432.1024', $argument->template());
    self::assertEquals('$5,432.10', (string) $argument);
    $argument = new CurrencyMessageStruct(5432.1024, 'RUB');
    self::assertEquals('5432.1024', $argument->template());
    self::assertEquals('RUB5,432.10', (string) $argument);
    $argument = new CurrencyArgument('amount', -5432.1024, 'RUB');
    self::assertEquals('-5432.1024', $argument->template());
    self::assertEquals('-RUB5,432.10', (string) $argument);
    self::assertEquals('-5 432,10 руб.', $argument->format('ru_RU'));
    self::assertEquals('amount', $argument->key());
    self::assertEquals(-5432.1024, $argument->amount());
    self::assertEquals('RUB', $argument->currency());
    self::assertTrue($argument->arguments()->isEmpty());
  }

  public function testCurrencyPrecision() {
    $argument = new CurrencyMessageWithPrecision(1292.9529, 'USD', 4);
    self::assertEquals('1292.9529', $argument->template());
    self::assertEquals('$1,292.9529', (string) $argument);
    $argument = new CurrencyMessageWithPrecision(1292.9529, 'USD', 5);
    self::assertEquals('1292.9529', $argument->template());
    self::assertEquals('$1,292.95290', (string) $argument);
    $argument = new CurrencyMessageWithPrecision(1292.959, 'RUB', 5);
    self::assertEquals('1292.959', $argument->template());
    self::assertEquals('RUB1,292.95900', (string) $argument);
    $argument = new CurrencyArgumentWithPrecision('amount', -5432.1024, 'RUB', 6);
    self::assertEquals('-5432.1024', $argument->template());
    self::assertEquals('-RUB5,432.102400', (string) $argument);
    self::assertEquals('-5 432,102400 руб.', $argument->format('ru_RU'));
    self::assertEquals(-5432.1024, $argument->amount());
    self::assertEquals('RUB', $argument->currency());
    $argument = new CurrencyArgumentWithPrecision('amount', -0.12, 'RUB', 0);
    self::assertEquals('-0.12', $argument->template());
    self::assertEquals('-RUB0', (string) $argument);
    self::assertEquals('-0 руб.', $argument->format('ru_RU'));
    $argument = new CurrencyArgumentWithPrecision('amount', -0.12, 'RUB', 1);
    self::assertEquals('-0.12', $argument->template());
    self::assertEquals('-RUB0.1', (string) $argument);
    self::assertEquals('-0,1 руб.', $argument->format('ru_RU'));
    $argument = new CurrencyArgumentWithPrecision('amount', -0.12, 'RUB', 2);
    self::assertEquals('-0.12', $argument->template());
    self::assertEquals('-RUB0.12', (string) $argument);
    self::assertEquals('-0,12 руб.', $argument->format('ru_RU'));
    $argument = new CurrencyArgumentWithPrecision('amount', -0.12, 'RUB', 3);
    self::assertEquals('-0.12', $argument->template());
    self::assertEquals('-RUB0.120', (string) $argument);
    self::assertEquals('-0,120 руб.', $argument->format('ru_RU'));
    $argument = new CurrencyArgumentWithPrecision('amount', -12, 'RUB', 0);
    self::assertEquals('-12', $argument->template());
    self::assertEquals('-RUB12', (string) $argument);
    self::assertEquals('-12 руб.', $argument->format('ru_RU'));
    $argument = new CurrencyArgumentWithPrecision('amount', -12, 'RUB', 1);
    self::assertEquals('-12.0', $argument->template());
    self::assertEquals('-RUB12.0', (string) $argument);
    self::assertEquals('-12,0 руб.', $argument->format('ru_RU'));
    $argument = new CurrencyArgumentWithPrecision('amount', -12, 'RUB', 2);
    self::assertEquals('-12.00', $argument->template());
    self::assertEquals('-RUB12.00', (string) $argument);
    self::assertEquals('-12,00 руб.', $argument->format('ru_RU'));
  }

  public function testFloat() {
    $argument = new FloatArgument('count', 5000);
    self::assertEquals('5000', $argument->template());
    self::assertEquals('5,000', (string) $argument);
    self::assertEquals('count', $argument->key());
    self::assertTrue($argument->arguments()->isEmpty());
    $argument = new FloatArgument('count', 5432.10);
    self::assertEquals('5432.1', $argument->template());
    self::assertEquals('5,432.1', (string) $argument);
    $argument = new FloatArgument('count', 5000.54321);
    self::assertEquals('5,000.543', (string) $argument);
    self::assertEquals('5000.54321', $argument->template());
    self::assertEquals('5 000,543', $argument->format('ru_RU')); // 5&nbsp;000,543
    $argument = new FloatArgument('count', 6.54321, '#,#00.000#');
    self::assertEquals('6.54321', $argument->template());
    self::assertEquals('06.5432', (string) $argument);
    $argument = new FloatArgument('count', 123456.54321, '#,#000.000#');
    self::assertEquals('12,3456.5432', (string) $argument);
    $argument = new FloatArgument('count', 6543.21, '#.#');
    self::assertEquals('6543.21', $argument->template());
    self::assertEquals('6543.2', (string) $argument);
  }

  public function testInteger() {
    $argument = new IntegerMessage(5000);
    self::assertEquals('5000', $argument->template());
    self::assertEquals('5,000', (string) $argument);
    self::assertTrue($argument->arguments()->isEmpty());
    $argument = new IntegerArgument('count', -5000);
    self::assertEquals('-5000', $argument->template());
    self::assertEquals('-5,000', (string) $argument);
    self::assertEquals('-5 000', $argument->format('ru_RU')); // -5&nbsp;000
    self::assertEquals('count', $argument->key());
  }

  public function testPercent() {
    $argument = new PercentMessage(0.05);
    self::assertEquals('0.05', $argument->template());
    self::assertEquals('5%', (string) $argument);
    self::assertTrue($argument->arguments()->isEmpty());
    $argument = new PercentArgument('percent', 5);
    self::assertEquals('5', $argument->template());
    self::assertEquals('500%', (string) $argument);
    self::assertEquals('500 %', $argument->format('ru_RU')); // 500&nbsp;%
    self::assertEquals('percent', $argument->key());
    self::assertTrue($argument->arguments()->isEmpty());
  }
}
