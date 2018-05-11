<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Exception;

use Xtuple\Util\Exception\AbstractThrowable;
use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ListMessage;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class Exception
  extends AbstractThrowable
  implements Throwable {
  /**
   * @param string           $message
   * @param string[]         $parameters
   * @param \Throwable       $previous
   * @param null|ListMessage $errors
   * @param int              $code
   */
  public function __construct(string $message, array $parameters = [], ?\Throwable $previous = null,
                              ?ListMessage $errors = null, int $code = 0) {
    parent::__construct(new MessageWithTokens($message, $parameters), $previous, $errors, $code);
  }
}
