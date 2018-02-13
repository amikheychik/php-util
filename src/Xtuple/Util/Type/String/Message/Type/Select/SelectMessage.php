<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Select;

use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;
use Xtuple\Util\Type\String\Message\Message\Message;

interface SelectMessage
  extends Message {
  public function value(): string;

  public function default(): Message;

  public function options(): SetArgument;
}
