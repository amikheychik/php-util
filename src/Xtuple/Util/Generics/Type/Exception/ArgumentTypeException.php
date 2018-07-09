<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type\Exception;

use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class ArgumentTypeException
  extends AbstractTypeThrowable {
  public function __construct(string $required, string $given, int $argument = 1, ?\Throwable $previous = null) {
    parent::__construct(
      new MessageWithTokens(
        'Argument {argument} must be of the type {required}, instance of {given} given',
        compact('argument', 'required', 'given')
      ),
      $previous
    );
  }
}
