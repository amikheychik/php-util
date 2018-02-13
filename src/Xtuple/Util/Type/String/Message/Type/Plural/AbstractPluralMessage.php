<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Plural;

use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;
use Xtuple\Util\Type\String\Message\Message\AbstractMessage;
use Xtuple\Util\Type\String\Message\Message\Message;
use Xtuple\Util\Type\String\Message\Type\Number\NumberMessage;

abstract class AbstractPluralMessage
  extends AbstractMessage
  implements PluralMessage {
  /** @var PluralMessage */
  private $message;

  public function __construct(PluralMessage $message) {
    parent::__construct($message);
    $this->message = $message;
  }

  public final function count(): NumberMessage {
    return $this->message->count();
  }

  public final function singular(): ?Message {
    return $this->message->singular();
  }

  public final function plural(): Message {
    return $this->message->plural();
  }

  public final function plurals(): SetArgument {
    return $this->message->plurals();
  }

  public final function offset(): ?float {
    return $this->message->offset();
  }
}
