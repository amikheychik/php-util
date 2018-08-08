<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\JWT\Claim\Claim\Registered\Audience\AudienceStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Subject\SubjectStruct;

class ArrayMapClaimTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $claims = new class (new ArrayMapClaim([
      new AudienceStruct('audience'),
      new SubjectStruct('subject'),
    ]))
      extends AbstractMapClaim {
    };
    self::assertFalse($claims->isEmpty());
    self::assertEquals(2, $claims->count());
    self::assertEquals('aud: audience', (string) $claims->get('aud'));
    self::assertNull($claims->get('iss'));
  }
}
