<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\HTTP\Client\Client as HTTP;
use Xtuple\Util\HTTP\Client\Exception\Exception;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\MapResult;
use Xtuple\Util\HTTP\Client\Result\Result;
use Xtuple\Util\HTTP\Client\Result\ResultWithThrowable;
use Xtuple\Util\HTTP\Request\Collection\Map\ArrayMapRequest;
use Xtuple\Util\HTTP\Request\Collection\Map\MapRequest;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\OAuth2\Client\Request\RequestWithAccessToken;
use Xtuple\Util\OAuth2\Client\Token\Exchange\Exchange;

final class HTTPClient
  implements Client {
  /** @var HTTP */
  private $http;
  /** @var Exchange */
  private $exchange;

  public function __construct(HTTP $http, Exchange $exchange) {
    $this->http = $http;
    $this->exchange = $exchange;
  }

  public function send(Request $request): Result {
    try {
      return $this->sendMany(new ArrayMapRequest([$request]))->get('0');
    }
    catch (\Throwable $e) {
      return new ResultWithThrowable(
        (string) $request->uri(),
        new ChainException($e, 'Failed OAuth2 HTTP request')
      );
    }
  }

  public function sendMany(MapRequest $requests): MapResult {
    try {
      $token = $this->exchange->token();
      /** @var Request[] $requestsWithTokens */
      $requestsWithTokens = [];
      foreach ($requests as $i => $request) {
        $requestsWithTokens[$i] = new RequestWithAccessToken($request, $token);
      }
      return $this->http->sendMany(new ArrayMapRequest($requestsWithTokens));
    }
    catch (\Throwable $e) {
      throw new Exception('Failed OAuth2 HTTP request', [], $e);
    }
  }
}
