<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Exception;

use Xtuple\Util\Exception\AbstractThrowable;
use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ArrayListMessage;
use Xtuple\Util\Type\String\Message\Message\Message;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

final class OpenSSLException
  extends AbstractThrowable
  implements OpenSSLThrowable {
  public function __construct(?Message $error = null, ?\Throwable $previous = null, int $code = 0) {
    /** @noinspection PhpUnhandledExceptionInspection - $messages types are verified */
    parent::__construct(
      new StringMessage(openssl_error_string()),
      $previous,
      new ArrayListMessage(array_filter([$error])),
      $code
    );
  }
}
