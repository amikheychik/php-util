<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument;

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\MapArgument;
use Xtuple\Util\Type\String\Message\Message\MessageStruct;

final class ArgumentFromString
  extends AbstractArgument {
  public function __construct(string $key, string $template, MapArgument $arguments) {
    parent::__construct($key, new MessageStruct($template, $arguments));
  }
}
