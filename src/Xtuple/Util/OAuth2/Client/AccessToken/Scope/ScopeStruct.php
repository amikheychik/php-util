<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Scope;

final class ScopeStruct
  implements Scope {
  /** @var string */
  private $scope;

  public function __construct(string $scope) {
    $this->scope = $scope;
  }

  public function value(): string {
    return $this->scope;
  }
}
