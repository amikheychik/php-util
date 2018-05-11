<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Multi;

use Xtuple\Util\HTTP\Client\CURL\Exception\CURLMultiException;
use Xtuple\Util\HTTP\Client\CURL\Handle\Collection\Map\MapHandle;
use Xtuple\Util\HTTP\Client\Exception\Exception;
use Xtuple\Util\HTTP\Client\Exception\Throwable;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\ArrayMapResult;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\MapResult;
use Xtuple\Util\HTTP\Client\Result\ResultWithResponse;
use Xtuple\Util\HTTP\Client\Result\ResultWithThrowable;

final class MultiHandleMapHandle
  implements MultiHandle {
  /** @var resource */
  private $multi;
  /** @var MapHandle */
  private $handles;

  /**
   * @throws Throwable
   *
   * @param MapHandle $handles
   */
  public function __construct(MapHandle $handles) {
    $this->multi = curl_multi_init();
    if ($this->multi === false) {
      // @codeCoverageIgnoreStart
      // Unable to reproduce if curl_multi_init() failure
      throw new Exception('cURL multi handle initialization error');
      // @codeCoverageIgnoreEnd
    }
    foreach ($handles as $i => $handle) {
      $result = curl_multi_add_handle($this->multi, $handle->handle());
      if ($result !== CURLM_OK) {
        throw new CURLMultiException($result);
      }
    }
    $this->handles = $handles;
  }

  public function __destruct() {
    curl_multi_close($this->multi);
  }

  public function execute(): MapResult {
    $active = null;
    $results = [];
    do {
      $status = curl_multi_exec($this->multi, $active);
      if ($status > 0) {
        // @codeCoverageIgnoreStart
        // Unable to reproduce if curl_multi_exec() failure
        throw new CURLMultiException($status);
        // @codeCoverageIgnoreEnd
      }
      if ($info = curl_multi_info_read($this->multi)) {
        if ($handle = $this->handles->getByResource($info['handle'])) {
          try {
            if ($info['result'] > CURLM_OK) {
              throw new CURLMultiException($info['result']);
            }
            $results[] = new ResultWithResponse(
              $handle->key(),
              $handle->response()
            );
          }
          catch (\Throwable $e) {
            $results[] = new ResultWithThrowable($handle->key(), $e);
          }
        }
        curl_multi_remove_handle($this->multi, $info['handle']);
      }
    }
    while ($status === CURLM_CALL_MULTI_PERFORM || $active);
    /** @noinspection PhpUnhandledExceptionInspection - $results types are verified */
    return new ArrayMapResult($results);
  }
}
