<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Currency;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberArgument;

/** @noinspection LongInheritanceChainInspection */
abstract class AbstractCurrencyArgument
  extends AbstractNumberArgument
  implements CurrencyMessage {
  /** @var CurrencyMessage */
  private $message;

  public function __construct(string $key, CurrencyMessage $message) {
    parent::__construct($key, $message);
    $this->message = $message;
  }

  public final function amount(): float {
    return $this->message->amount();
  }

  public final function currency(): string {
    return $this->message->currency();
  }
}
