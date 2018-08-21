<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Token\Access;

use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

interface AccessToken {
  public function value(): string;

  public function type(): string;

  public function expiresAt(): Timestamp;

  public function refresh(): ?string;
}
