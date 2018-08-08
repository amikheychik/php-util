<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken;

use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

final class AccessTokenStruct
  implements AccessToken {
  /** @var string */
  private $value;
  /** @var string */
  private $type;
  /** @var Timestamp */
  private $expiresAt;

  public function __construct(string $value, string $type, Timestamp $expiresAt) {
    $this->value = $value;
    $this->type = $type;
    $this->expiresAt = $expiresAt;
  }

  public function value(): string {
    return $this->value;
  }

  public function type(): string {
    return $this->type;
  }

  public function expiresAt(): Timestamp {
    return $this->expiresAt;
  }
}
