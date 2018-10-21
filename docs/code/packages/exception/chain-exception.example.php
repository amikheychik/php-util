<?php
/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Exception;

try {
  throw new Exception('HTTP error {code}: {message}', [
    'code' => 404,
    'message' => 'Page not found',
  ]);
}
catch (\Throwable $previous) {
  throw new ChainException($previous, 'API request {request} failed', [
    'request' => 'api/v2/address',
  ]);
}
