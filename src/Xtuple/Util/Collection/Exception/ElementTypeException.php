<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Exception;

use Xtuple\Util\Exception\AbstractThrowable;
use Xtuple\Util\Generics\Type\CastType;
use Xtuple\Util\Generics\Type\StrictType;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class ElementTypeException
  extends AbstractThrowable {
  public function __construct(string $index, StrictType $required, $element, ?\Throwable $previous = null,
                              int $code = 0) {
    parent::__construct(new MessageWithTokens('Element {index} is {given}, {required} is required.', [
      'index' => $index,
      'required' => $required->fqn(),
      'given' => (new CastType($element))->fqn(),
    ]), $previous, null, $code);
  }
}
