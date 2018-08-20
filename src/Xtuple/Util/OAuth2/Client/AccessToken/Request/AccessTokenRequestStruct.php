<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request;

use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\HTTP\Request\AbstractRequest;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

final class AccessTokenRequestStruct
  extends AbstractRequest
  implements AccessTokenRequest {
  /** @var Timestamp */
  private $issuedAt;
  /** @var Key */
  private $key;

  public function __construct(Request $request, Timestamp $issuedAt, Key $key) {
    parent::__construct($request);
    $this->issuedAt = $issuedAt;
    $this->key = $key;
  }

  public function issuedAt(): Timestamp {
    return $this->issuedAt;
  }

  public function key(): Key {
    return $this->key;
  }
}
