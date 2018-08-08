<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request;

use Xtuple\Util\HTTP\Request\AbstractRequest;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

final class AccessTokenRequestStruct
  extends AbstractRequest
  implements AccessTokenRequest {
  /** @var Timestamp */
  private $issuedAt;

  public function __construct(Request $request, Timestamp $issuedAt) {
    parent::__construct($request);
    $this->issuedAt = $issuedAt;
  }

  public function issuedAt(): Timestamp {
    return $this->issuedAt;
  }
}
