<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Message;

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\MapArgument;

abstract class AbstractMessage
  implements Message {
  /** @var Message */
  private $message;

  public function __construct(Message $message) {
    $this->message = $message;
  }

  public final function __toString(): string {
    return $this->message->__toString();
  }

  public final function format(string $locale): string {
    return $this->message->format($locale);
  }

  public final function template(): string {
    return $this->message->template();
  }

  public final function arguments(): MapArgument {
    return $this->message->arguments();
  }
}
