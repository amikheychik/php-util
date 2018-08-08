<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\JWT\Claim\Claim\Registered\Audience\AudienceStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Subject\SubjectStruct;

class MergedMapClaimTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $claims = new MergedMapClaim(
      new ArrayMapClaim([
        new AudienceStruct('audience'),
      ]),
      new ArrayMapClaim([
        new AudienceStruct('another-audience'),
        new SubjectStruct('subject'),
      ])
    );
    self::assertFalse($claims->isEmpty());
    self::assertEquals(2, $claims->count());
    self::assertEquals('aud: another-audience', (string) $claims->get('aud'));
    self::assertEquals('sub: subject', (string) $claims->get('sub'));
    self::assertNull($claims->get('iss'));
  }
}
