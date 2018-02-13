<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Select;

use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;
use Xtuple\Util\Type\String\Message\Message\AbstractMessage;
use Xtuple\Util\Type\String\Message\Message\Message;

abstract class AbstractSelectMessage
  extends AbstractMessage
  implements SelectMessage {
  /** @var SelectMessage */
  private $message;

  public function __construct(SelectMessage $message) {
    parent::__construct($message);
    $this->message = $message;
  }

  public final function value(): string {
    return $this->message->value();
  }

  public final function default(): Message {
    return $this->message->default();
  }

  public final function options(): SetArgument {
    return $this->message->options();
  }
}
