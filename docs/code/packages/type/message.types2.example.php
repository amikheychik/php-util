<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\String\Message\Type\Number\Currency\CurrencyMessageStruct;
use Xtuple\Util\Type\String\Message\Type\Number\Float\FloatMessage;
use Xtuple\Util\Type\String\Message\Type\Number\Integer\IntegerMessage;
use Xtuple\Util\Type\String\Message\Type\Number\Percent\PercentMessage;

$integer = new IntegerMessage(5000);
// __toString() defaults to en_US.UTF-8 locale
(string) $integer === '5,000';
$integer->format('ru_RU') === '5 000'; // 5&nbsp;000

$float = new FloatMessage(12345.54321);
(string) $float === '12,345.543';
$float->format('ru_RU') === '12 345,543'; // 12&nbsp;345,543

// FloatMessage allows to provide custom format
$float = new FloatMessage(6.54321, '#,#00.000#');
(string) $float === '006.5432';

// Note: "," is shifted in this example:
$float = new FloatMessage(123456.54321, '#,#000.000#');
(string) $float === '12,3456.5432';

// Note: PercentMessage requires a float value, and 1 is 100%
$percent = new PercentMessage(0.05);
(string) $percent === '5%';
$percent->format('ru_RU') === '5 %'; // 5&nbsp;%

$percent = new PercentMessage(5);
(string) $percent === '500%';

// CurrencyMessage requires currency 3-letter ISO 4217 code
$currency = new CurrencyMessageStruct(5000, 'USD');
(string) $currency === '$5,000.00';
$currency->format('ru_RU') === '5 000,00 $'; // 5&nbsp;000,00&nbsp;$

// Note: currency formatted according to locale, not currency itself
$currency = new CurrencyMessageStruct(-5432.1024, 'RUB');
(string) $currency === '-RUB5,432.10'; // en_US.UTF-8 locale
$currency->format('ru_RU') === '-5 432,10 руб.'; // -5&nbsp;432,10&nbsp;руб.
