<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Currency;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberArgument;

final class CurrencyArgument
  extends AbstractNumberArgument {
  /**
   * @param string $key
   * @param float  $amount
   * @param string $currency - 3-letter ISO 4217
   */
  public function __construct(string $key, float $amount, string $currency) {
    parent::__construct($key, new CurrencyMessage($amount, $currency));
  }
}
