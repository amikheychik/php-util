<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Endpoint;

use Xtuple\Util\HTTP\Request\URI\URL\URL;

interface Endpoint {
  public function token(): URL;
}
