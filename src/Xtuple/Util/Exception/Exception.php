<?php declare(strict_types=1);

namespace Xtuple\Util\Exception;

use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class Exception
  extends AbstractThrowable {
  /**
   * @param string $message
   * @param array  $parameters
   * @param int    $code
   */
  public function __construct(string $message, array $parameters = [], int $code = 0) {
    parent::__construct(new MessageWithTokens($message, $parameters), null, null, $code);
  }
}
