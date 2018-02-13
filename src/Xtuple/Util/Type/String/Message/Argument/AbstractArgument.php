<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument;

use Xtuple\Util\Type\String\Message\Message\AbstractMessage;
use Xtuple\Util\Type\String\Message\Message\Message;

abstract class AbstractArgument
  extends AbstractMessage
  implements Argument {
  /** @var string */
  private $key;

  public function __construct(string $key, Message $message) {
    parent::__construct($message);
    $this->key = $key;
  }

  public final function key(): string {
    return $this->key;
  }
}
