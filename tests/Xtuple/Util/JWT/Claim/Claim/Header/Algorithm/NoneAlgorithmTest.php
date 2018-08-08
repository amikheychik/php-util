<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm;

use PHPUnit\Framework\TestCase;

class NoneAlgorithmTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $claim = new NoneAlgorithm();
    self::assertEquals('alg', $claim->name());
    self::assertEquals('none', $claim->value());
    self::assertEquals('alg: none', (string) $claim);
    self::assertEquals('', $claim->sign('Test'));
  }
}
