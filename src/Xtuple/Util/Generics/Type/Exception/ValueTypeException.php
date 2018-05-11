<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type\Exception;

use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class ValueTypeException
  extends AbstractTypeThrowable {
  public function __construct(string $required, string $given) {
    parent::__construct(new MessageWithTokens('Value must be of the type {required}, instance of {given} given', [
      'required' => $required,
      'given' => $given,
    ]));
  }
}
