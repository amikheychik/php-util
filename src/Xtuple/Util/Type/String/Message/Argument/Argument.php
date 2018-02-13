<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument;

use Xtuple\Util\Type\String\Message\Message\Message;

interface Argument
  extends Message {
  public function key(): string;
}
