<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Integer;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberArgument;

final class IntegerArgument
  extends AbstractNumberArgument {
  public function __construct(string $key, int $value) {
    parent::__construct($key, new IntegerMessage($value));
  }
}
