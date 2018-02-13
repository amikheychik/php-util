<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\String;

use Xtuple\Util\Type\String\Message\Argument\AbstractArgument;

final class StringArgument
  extends AbstractArgument {
  public function __construct(string $key, string $value) {
    parent::__construct($key, new StringMessage($value));
  }
}
