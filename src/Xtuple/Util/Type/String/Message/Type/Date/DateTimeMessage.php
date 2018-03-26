<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Date;

use Xtuple\Util\Type\String\Message\Message\Message;

interface DateTimeMessage
  extends Message {
  public function timezone(?string $timezone = null): string;
}
