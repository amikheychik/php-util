<?php
/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

use Xtuple\Util\Exception\MultiErrorException;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

// See https://secure.php.net/manual/en/function.curl-multi-strerror.php
$ch1 = curl_init('http://example.com/');
$ch2 = curl_init('http://php.net/');
$mh = curl_multi_init();
curl_multi_add_handle($mh, $ch1);
curl_multi_add_handle($mh, $ch2);
$errors = [];
do {
  $status = curl_multi_exec($mh, $active);
  if ($status > 0) {
    $errors[] = new StringMessage(curl_multi_strerror($status));
  }
}
while ($status === CURLM_CALL_MULTI_PERFORM || $active);

if (!empty($errors)) {
  // Allow to log/process all occurred errors,
  // instead of throwing an exception after the first one has occurred.
  throw new MultiErrorException($errors, 'HTTP requests failed');
}
