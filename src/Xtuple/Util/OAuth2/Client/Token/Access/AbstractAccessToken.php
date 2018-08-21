<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Token\Access;

use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

abstract class AbstractAccessToken
  implements AccessToken {
  /** @var AccessToken */
  private $token;

  public function __construct(AccessToken $token) {
    $this->token = $token;
  }

  public final function value(): string {
    return $this->token->value();
  }

  public final function type(): string {
    return $this->token->type();
  }

  public final function expiresAt(): Timestamp {
    return $this->token->expiresAt();
  }

  public final function refresh(): ?string {
    return $this->token->refresh();
  }
}
