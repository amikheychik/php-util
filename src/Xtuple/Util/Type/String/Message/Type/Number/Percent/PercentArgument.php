<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Percent;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberArgument;

final class PercentArgument
  extends AbstractNumberArgument {
  public function __construct(string $key, float $value) {
    parent::__construct($key, new PercentMessage($value));
  }
}
