<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request\JSON;

use Xtuple\Util\Cache\Key\Key;
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
  /** @var Key */
  private $key;

  public function __construct(Endpoint $endpoint, JSONBody $data, Timestamp $issuedAt, Key $key) {
    parent::__construct(new POSTJSONRequest($endpoint->token(), $data));
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
