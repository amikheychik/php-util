<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Client\Client;
use Xtuple\Util\HTTP\Client\CURL\Configuration\Configuration;
use Xtuple\Util\HTTP\Client\CURL\Handle\BinaryHandle;
use Xtuple\Util\HTTP\Client\CURL\Handle\Collection\Map\ArrayMapHandle;
use Xtuple\Util\HTTP\Client\CURL\Handle\Multi\MultiHandleMapHandle;
use Xtuple\Util\HTTP\Client\Exception\Exception;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\MapResult;
use Xtuple\Util\HTTP\Client\Result\Result;
use Xtuple\Util\HTTP\Client\Result\ResultWithResponse;
use Xtuple\Util\HTTP\Client\Result\ResultWithThrowable;
use Xtuple\Util\HTTP\Request\Collection\Map\MapRequest;
use Xtuple\Util\HTTP\Request\Request;

final class CURLClient
  implements Client {
  /** @var Configuration */
  private $configuration;

  public function __construct(Configuration $configuration) {
    $this->configuration = $configuration;
  }

  public function send(Request $request): Result {
    $key = (string) $request->uri();
    try {
      $handle = new BinaryHandle($key, $request, $this->configuration);
      return new ResultWithResponse($key, $handle->response());
    }
    catch (Throwable $e) {
      return new ResultWithThrowable(
        $key,
        new Exception('HTTP request failed', [], $e)
      );
    }
  }

  public function sendMany(MapRequest $requests): MapResult {
    try {
      $handles = [];
      foreach ($requests as $i => $request) {
        $handles[] = new BinaryHandle($i, $request, $this->configuration);
      }
      /** @noinspection PhpUnhandledExceptionInspection - $handles types are verified */
      $handle = new MultiHandleMapHandle(new ArrayMapHandle($handles));
      return $handle->execute();
    }
      // @codeCoverageIgnoreStart
      // Unable to reproduce curl_multi_exec() failure
    catch (Throwable $e) {
      throw new Exception('Failed to process multiple HTTP requests', [], $e);
    }
    // @codeCoverageIgnoreEnd
  }
}
