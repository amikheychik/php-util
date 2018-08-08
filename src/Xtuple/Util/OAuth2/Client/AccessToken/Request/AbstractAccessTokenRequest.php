<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request;

use Xtuple\Util\HTTP\Request\AbstractRequest;
use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

abstract class AbstractAccessTokenRequest
  extends AbstractRequest
  implements AccessTokenRequest {
  /** @var AccessTokenRequest */
  private $request;

  public function __construct(AccessTokenRequest $request) {
    parent::__construct($request);
    $this->request = $request;
  }

  public final function issuedAt(): Timestamp {
    return $this->request->issuedAt();
  }
}
