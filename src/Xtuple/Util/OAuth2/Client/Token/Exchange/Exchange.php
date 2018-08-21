<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Token\Exchange;

use Xtuple\Util\OAuth2\Client\Token\Access\AccessToken;

interface Exchange {
  public function token(): AccessToken;
}
