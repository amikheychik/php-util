<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request\Cache;

use Xtuple\Util\Cache\Key\AbstractKey;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequest;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\URLSafeBase64EncodedStringFromString;

final class KeyAccessTokenRequest
  extends AbstractKey {
  /**
   * @throws Throwable
   *
   * @param AccessTokenRequest $request
   */
  public function __construct(AccessTokenRequest $request) {
    try {
      parent::__construct(new KeyStruct([
        (string) $request->uri(),
        sha1((string) new URLSafeBase64EncodedStringFromString(
          (new StringBodyFromBody($request->body()))->content()
        )),
      ]));
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to create an access token request cache key');
    }
  }
}
