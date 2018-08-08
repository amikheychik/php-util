<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Endpoint;

use Xtuple\Util\HTTP\Request\URI\URL\URL;

final class EndpointStruct
  implements Endpoint {
  /** @var URL */
  private $token;

  public function __construct(URL $token) {
    $this->token = $token;
  }

  public function token(): URL {
    return $this->token;
  }
}
