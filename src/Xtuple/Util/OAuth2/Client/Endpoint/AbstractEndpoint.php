<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Endpoint;

use Xtuple\Util\HTTP\Request\URI\URL\URL;

abstract class AbstractEndpoint
  implements Endpoint {
  /** @var Endpoint */
  private $endpoint;

  public function __construct(Endpoint $endpoint) {
    $this->endpoint = $endpoint;
  }

  public final function token(): URL {
    return $this->endpoint->token();
  }
}
