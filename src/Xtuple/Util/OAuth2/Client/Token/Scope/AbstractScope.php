<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Token\Scope;

abstract class AbstractScope
  implements Scope {
  /** @var Scope */
  private $scope;

  public function __construct(Scope $scope) {
    $this->scope = $scope;
  }

  public final function value(): string {
    return $this->scope->value();
  }
}
