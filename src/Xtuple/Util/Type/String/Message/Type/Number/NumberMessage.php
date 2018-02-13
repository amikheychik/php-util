<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number;

use Xtuple\Util\Type\String\Message\Message\Message;

interface NumberMessage
  extends Message {
  public function format(string $locale): string;
}
