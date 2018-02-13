<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Float;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberArgument;

final class FloatArgument
  extends AbstractNumberArgument {
  public function __construct(string $key, float $value, ?string $format = null) {
    parent::__construct($key, new FloatMessage($value, $format));
  }
}
