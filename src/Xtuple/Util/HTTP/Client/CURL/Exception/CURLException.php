<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Exception;

use Xtuple\Util\HTTP\Client\Exception\AbstractThrowable;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class CURLException
  extends AbstractThrowable {
  /**
   * @param resource $handle
   */
  public function __construct($handle) {
    $error = curl_errno($handle);
    parent::__construct(new MessageWithTokens('cURL error: [{code}] {message}', [
      'code' => $error,
      'message' => curl_strerror($error),
    ]), null, null, $error);
  }
}
