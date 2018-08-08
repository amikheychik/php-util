<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Client\Client;
use Xtuple\Util\HTTP\Client\Exception\Exception;
use Xtuple\Util\HTTP\Response\JSON\JSONResponseStruct;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequest;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

final class FreshAccessToken
  extends AbstractAccessToken {
  /**
   * @throws Throwable
   *
   * @param Client             $http
   * @param AccessTokenRequest $accessTokenRequest
   */
  public function __construct(Client $http, AccessTokenRequest $accessTokenRequest) {
    try {
      $response = $http->send($accessTokenRequest)->response();
      if ($response->status()->code() !== 200) {
        throw new Exception('Access token request failed: {status}', [
          'status' => $response->status(),
        ]);
      }
      $data = (new JSONResponseStruct($response))->json();
      parent::__construct(new AccessTokenStruct(
        (string) $data->get(['access_token']),
        (string) $data->get(['token_type']),
        new TimestampStruct($accessTokenRequest->issuedAt()->seconds() + (int) $data->get(['expires_in']))
      ));
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to retrieve a fresh access token');
    }
  }
}
