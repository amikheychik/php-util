<?php declare(strict_types=1);

namespace Xtuple\Util\Exception;

use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ListMessage;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class ChainException
  extends AbstractThrowable {
  public function __construct(\Throwable $previous, string $message, array $parameters = [],
                              ?ListMessage $errors = null, int $code = 0) {
    if ($errors === null
      && $previous instanceof Throwable) {
      $errors = $previous->errors();
    }
    parent::__construct(new MessageWithTokens($message, $parameters), $previous, $errors, $code);
  }
}
