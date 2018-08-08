<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken;

use Xtuple\Util\Cache\Cache;
use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Client\Client;
use Xtuple\Util\OAuth2\Client\AccessToken\Cache\RecordAccessToken;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequest;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\Cache\KeyAccessTokenRequest;

final class CachedAccessToken
  extends AbstractAccessToken {
  /**
   * @throws Throwable
   *
   * @param Cache              $cache
   * @param Client             $http
   * @param AccessTokenRequest $accessTokenRequest
   */
  public function __construct(Cache $cache, Client $http, AccessTokenRequest $accessTokenRequest) {
    try {
      $key = new KeyAccessTokenRequest($accessTokenRequest);
      if ($record = $cache->find($key)) {
        /** @var AccessToken $token */
        $token = $record->value();
        if (!($token instanceof AccessToken)) {
          $token = null;
          $cache->delete($key);
        }
      }
      if (!isset($token)) {
        $token = new FreshAccessToken($http, $accessTokenRequest);
        $cache->insert(new RecordAccessToken($key, $token));
      }
      parent::__construct($token);
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to retrieve an access token');
    }
  }
}
