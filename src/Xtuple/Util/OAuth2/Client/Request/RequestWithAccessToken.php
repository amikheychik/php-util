<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Request;

use Xtuple\Util\HTTP\Message\Header\Collection\Set\MergeSetHeader;
use Xtuple\Util\HTTP\Request\AbstractRequest;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\HTTP\Request\RequestStruct;
use Xtuple\Util\OAuth2\Client\Request\Header\Collection\Set\AccessTokenSetHeader;
use Xtuple\Util\OAuth2\Client\Token\Access\AccessToken;

final class RequestWithAccessToken
  extends AbstractRequest {
  public function __construct(Request $request, AccessToken $token) {
    parent::__construct(new RequestStruct(
      $request->method(),
      $request->uri(),
      new MergeSetHeader(
        $request->headers(),
        new AccessTokenSetHeader($token)
      ),
      $request->body()
    ));
  }
}
