<?php declare(strict_types=1);

namespace Xtuple\Util\Exception;

use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ArrayListMessage;
use Xtuple\Util\Type\String\Message\Message\Message;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class MultiErrorException
  extends AbstractThrowable {
  /**
   * @throws \Throwable - if $errors is of the wrong type.
   *
   * @param Message[] $errors
   * @param string    $message
   * @param array     $parameters
   * @param int       $code
   */
  public function __construct(array $errors, string $message, array $parameters = [], int $code = 0) {
    parent::__construct(new MessageWithTokens($message, $parameters), null, new ArrayListMessage($errors), $code);
  }
}
