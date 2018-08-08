<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Test;

use Xtuple\Util\HTTP\Client\Client;
use Xtuple\Util\HTTP\Client\Exception\Exception;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\ArrayMapResult;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\MapResult;
use Xtuple\Util\HTTP\Client\Result\Result;
use Xtuple\Util\HTTP\Client\Result\ResultWithResponse;
use Xtuple\Util\HTTP\Client\Result\ResultWithThrowable;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Request\Collection\Map\ArrayMapRequest;
use Xtuple\Util\HTTP\Request\Collection\Map\MapRequest;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\HTTP\Response\ResponseStruct;
use Xtuple\Util\HTTP\Response\Status\StatusStruct;

final class TestClient
  implements Client {
  public function send(Request $request): Result {
    $key = (string) $request->uri();
    try {
      return $this->sendMany(new ArrayMapRequest([
        $key => $request,
      ]))->get($key);
    }
    catch (\Throwable $e) {
      return new ResultWithThrowable($key, $e);
    }
  }

  public function sendMany(MapRequest $requests): MapResult {
    if ($requests->isEmpty()) {
      throw new Exception('No requests');
    }
    $results = [];
    foreach ($requests as $i => $request) {
      if ($error = $request->headers()->get('Response-Error')) {
        throw new Exception($error->value());
      }
      /** @noinspection PhpUnhandledExceptionInspection */
      $results[$i] = new ResultWithResponse($i, new ResponseStruct(
        new StatusStruct(
          '1.1',
          ($code = $request->headers()->get('Response-Code')) ? (int) $code->value() : 200,
          ($reason = $request->headers()->get('Response-Reason')) ? $reason->value() : 'OK'
        ),
        new ArraySetHeader(),
        $request->body()
      ));
    }
    /** @noinspection PhpUnhandledExceptionInspection */
    return new ArrayMapResult($results);
  }
}

