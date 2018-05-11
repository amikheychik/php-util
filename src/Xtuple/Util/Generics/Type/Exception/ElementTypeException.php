<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type\Exception;

use Xtuple\Util\Generics\Type\CastType;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class ElementTypeException
  extends AbstractTypeThrowable {
  public function __construct(string $index, string $required, $element, ?\Throwable $previous = null) {
    parent::__construct(
      new MessageWithTokens('Element {index} must be of the type {required}, instance of {given} given', [
        'index' => $index,
        'required' => $required,
        'given' => (new CastType($element))->fqn(),
      ]),
      $previous
    );
  }
}
