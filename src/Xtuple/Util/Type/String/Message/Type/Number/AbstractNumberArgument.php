<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number;

use Xtuple\Util\Type\String\Message\Argument\AbstractArgument;

abstract class AbstractNumberArgument
  extends AbstractArgument
  implements NumberMessage {
  public function __construct(string $key, NumberMessage $message) {
    parent::__construct($key, $message);
  }
}
