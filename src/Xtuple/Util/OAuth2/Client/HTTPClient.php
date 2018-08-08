<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client;

use Xtuple\Util\Cache\Cache;
use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\HTTP\Client\Client as HTTP;
use Xtuple\Util\HTTP\Client\Exception\Exception;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\MapResult;
use Xtuple\Util\HTTP\Client\Result\Result;
use Xtuple\Util\HTTP\Client\Result\ResultWithThrowable;
use Xtuple\Util\HTTP\Request\Collection\Map\ArrayMapRequest;
use Xtuple\Util\HTTP\Request\Collection\Map\MapRequest;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\OAuth2\Client\AccessToken\CachedAccessToken;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequest;
use Xtuple\Util\OAuth2\Client\Request\RequestWithAccessToken;

final class HTTPClient
  implements Client {
  /** @var HTTP */
  private $http;
  /** @var Cache */
  private $tokens;
  /** @var AccessTokenRequest */
  private $requestAccessToken;

  public function __construct(HTTP $http, Cache $tokens, AccessTokenRequest $requestAccessToken) {
    $this->http = $http;
    $this->tokens = $tokens;
    $this->requestAccessToken = $requestAccessToken;
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
      /** @var Request[] $requestsWithTokens */
      $requestsWithTokens = [];
      foreach ($requests as $i => $request) {
        $requestsWithTokens[$i] = new RequestWithAccessToken(
          $request,
          new CachedAccessToken($this->tokens, $this->http, $this->requestAccessToken)
        );
      }
      return $this->http->sendMany(new ArrayMapRequest($requestsWithTokens));
    }
    catch (\Throwable $e) {
      throw new Exception('Failed OAuth2 HTTP request', [], $e);
    }
  }
}
