<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Token\Access;

use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

final class AccessTokenStruct
  implements AccessToken {
  /** @var string */
  private $value;
  /** @var string */
  private $type;
  /** @var Timestamp */
  private $expiresAt;
  /** @var null|string */
  private $refresh;

  public function __construct(string $value, string $type, Timestamp $expiresAt, ?string $refresh) {
    $this->value = $value;
    $this->type = $type;
    $this->expiresAt = $expiresAt;
    $this->refresh = $refresh;
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

  public function refresh(): ?string {
    return $this->refresh;
  }
}
