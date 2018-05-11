<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Exception;

use Xtuple\Util\HTTP\Client\Exception\AbstractThrowable;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class CURLMultiException
  extends AbstractThrowable {
  public function __construct(int $code = 0) {
    parent::__construct(new MessageWithTokens('cURL multi error: [{code}] {message}', [
      'code' => $code,
      'message' => curl_multi_strerror($code),
    ]), null, null, $code);
  }
}
