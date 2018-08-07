<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Currency;

use Xtuple\Util\RegEx\RegExPattern;
use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberMessage;

final class CurrencyMessageWithPrecision
  extends AbstractNumberMessage
  implements CurrencyMessage {
  /** @var float */
  private $amount;
  /** @var string */
  private $currency;
  /** @var int */
  private $precision;

  /**
   * @param float  $amount
   * @param string $currency - 3-letter ISO 4217
   * @param int    $precision
   */
  public function __construct(float $amount, string $currency, int $precision) {
    parent::__construct((string) $amount);
    $this->amount = $amount;
    $this->currency = $currency;
    $this->precision = $precision;
  }

  public function format(string $locale): string {
    $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
    $amount = $formatter->formatCurrency($this->amount, $this->currency);
    $symbol = $formatter->getSymbol(\NumberFormatter::DECIMAL_SEPARATOR_SYMBOL);
    $parts = explode($symbol, $amount);
    if (count($parts) > 1) {
      $tail = array_pop($parts);
      $parts = [
        implode($symbol, $parts),
      ];
      if ($this->precision > 0) {
        $repeat = 0;
        if ($this->precision > 1
          || ($this->amount > 0 && floor($this->amount) === $this->amount)
          || ($this->amount < 0 && ceil($this->amount) === $this->amount)
        ) {
          $repeat = $this->precision;
        }
        $formatter = new \NumberFormatter($locale, \NumberFormatter::PATTERN_DECIMAL, strtr('#.{precision}#', [
          '{precision}' => str_repeat('0', $repeat),
        ]));
        $decimal = explode(
          $formatter->getSymbol(\NumberFormatter::DECIMAL_SEPARATOR_SYMBOL),
          $formatter->format($this->amount)
        );
      }
      $parts[] = (new RegExPattern('/^(\d+)/'))->replace($decimal[1] ?? '', $tail);
      $amount = implode(isset($decimal[1]) ? $symbol : '', $parts);
    }
    return $amount;
  }

  public function amount(): float {
    return $this->amount;
  }

  public function currency(): string {
    return $this->currency;
  }
}
