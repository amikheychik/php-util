<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Currency;

use Xtuple\Util\Type\String\Message\Type\Number\NumberMessage;

interface CurrencyMessage
  extends NumberMessage {
  public function amount(): float;

  public function currency(): string;
}
