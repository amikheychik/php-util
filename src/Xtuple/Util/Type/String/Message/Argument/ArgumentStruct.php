<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument;

use Xtuple\Util\Type\String\Message\Message\Message;

final class ArgumentStruct
  extends AbstractArgument {
  public function __construct(string $key, Message $message) {
    parent::__construct($key, $message);
  }
}
