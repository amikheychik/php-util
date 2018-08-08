<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Scope;

use PHPUnit\Framework\TestCase;

class ScopeStructTest
  extends TestCase {
  public function testConstructor() {
    $scope = new class (new ScopeStruct('scope'))
      extends AbstractScope {
    };
    self::assertEquals('scope', $scope->value());
  }
}
