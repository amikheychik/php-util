<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request\JSON;

use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBody;
use Xtuple\Util\HTTP\Request\AbstractRequest;
use Xtuple\Util\HTTP\Request\Request\JSON\POSTJSONRequest;
use Xtuple\Util\OAuth2\Client\AccessToken\Request\AccessTokenRequest;
use Xtuple\Util\OAuth2\Client\Endpoint\Endpoint;
use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

final class AccessTokenJSONRequest
  extends AbstractRequest
  implements AccessTokenRequest {
  /** @var Timestamp */
  private $issuedAt;

  public function __construct(Endpoint $endpoint, JSONBody $data, Timestamp $issuedAt) {
    parent::__construct(new POSTJSONRequest($endpoint->token(), $data));
    $this->issuedAt = $issuedAt;
  }

  public function issuedAt(): Timestamp {
    return $this->issuedAt;
  }
}
