<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Type\StringOrURI;

use PHPUnit\Framework\TestCase;

class StringOrURIClaimStructTest
  extends TestCase {
  public function testConstructor() {
    $claim = new class (new StringOrURIClaimStruct('test', 'http://example.com'))
      extends AbstractStringOrURIClaim {
    };
    self::assertEquals('test', $claim->name());
    self::assertEquals('http://example.com', $claim->value());
    self::assertEquals('test: http://example.com', (string) $claim);
  }
}
