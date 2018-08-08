<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken;

use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

interface AccessToken {
  public function value(): string;

  public function type(): string;

  public function expiresAt(): Timestamp;
}
