<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Currency;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberMessage;

final class CurrencyMessage
  extends AbstractNumberMessage {
  /** @var float */
  private $amount;
  /** @var string */
  private $currency;

  /**
   * @param float  $amount
   * @param string $currency - 3-letter ISO 4217
   */
  public function __construct(float $amount, string $currency) {
    parent::__construct((string) $amount);
    $this->amount = $amount;
    $this->currency = $currency;
  }

  public function format(string $locale): string {
    $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
    return $formatter->formatCurrency($this->amount, $this->currency);
  }
}
