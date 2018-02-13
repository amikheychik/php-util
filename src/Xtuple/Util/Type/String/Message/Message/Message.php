<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Message;

use Xtuple\Util\Type\String\Chars;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;

interface Message
  extends Chars {
  public function format(string $locale): string;

  public function template(): string;

  public function arguments(): SetArgument;
}
