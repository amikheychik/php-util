<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Scope;

interface Scope {
  public function value(): string;
}
