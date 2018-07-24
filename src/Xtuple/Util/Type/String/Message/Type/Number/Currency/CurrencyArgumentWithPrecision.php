<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Currency;

final class CurrencyArgumentWithPrecision
  extends AbstractCurrencyArgument {
  /**
   * @param string $key
   * @param float  $amount
   * @param string $currency - 3-letter ISO 4217
   * @param int    $precision
   */
  public function __construct(string $key, float $amount, string $currency, int $precision) {
    parent::__construct($key, new CurrencyMessageWithPrecision($amount, $currency, $precision));
  }
}
