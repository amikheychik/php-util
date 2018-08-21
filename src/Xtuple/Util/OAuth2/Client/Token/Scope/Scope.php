<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Token\Scope;

interface Scope {
  public function value(): string;
}
