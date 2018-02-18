<?php declare(strict_types=1);

namespace Xtuple\Util\Exception;

use Throwable;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\ArraySetArgument;
use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ListMessage;
use Xtuple\Util\Type\String\Message\Message\MessageStruct;

final class ExceptionWithArguments
  extends AbstractThrowable {
  public function __construct(string $message, ArraySetArgument $arguments, ?Throwable $previous = null,
                              ?ListMessage $errors = null, int $code = 0) {
    parent::__construct(new MessageStruct($message, $arguments), $previous, $errors, $code);
  }
}
