<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Registered;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\JWT\Claim\Claim\Registered\Audience\AudienceStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\ExpirationTime\ExpirationTimeStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt\IssuedAtStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Issuer\IssuerStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\JWTID\JWTIDStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\NotBefore\NotBeforeStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Subject\SubjectStruct;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class RegisteredMapClaimStructTest
  extends TestCase {
  public function testEmptyConstructor() {
    $claims = new RegisteredMapClaimStruct();
    self::assertTrue($claims->isEmpty());
    self::assertEquals(0, $claims->count());
    self::assertNull($claims->get('aud'));
  }

  /**
   * @throws \Throwable
   */
  public function testFullConstructor() {
    $now = time();
    $claims = new class (new RegisteredMapClaimStruct(
      new IssuerStruct('issuer'),
      new SubjectStruct('subject'),
      new AudienceStruct('audience'),
      new IssuedAtStruct(new DateTimeTimestampSeconds($now)),
      new ExpirationTimeStruct(new DateTimeTimestampSeconds($now + 3600)),
      new NotBeforeStruct(new DateTimeTimestampSeconds($now)),
      new JWTIDStruct('jwt_id')
    ))
      extends AbstractRegisteredMapClaim {
    };
    self::assertFalse($claims->isEmpty());
    self::assertEquals(7, $claims->count());
    self::assertEquals('issuer', $claims->get('iss')->value());
    self::assertEquals('subject', $claims->get('sub')->value());
    self::assertEquals('audience', $claims->get('aud')->value());
    self::assertEquals($now, $claims->get('iat')->value());
    self::assertEquals($now + 3600, $claims->get('exp')->value());
    self::assertEquals($now, $claims->get('nbf')->value());
    self::assertEquals('jwt_id', $claims->get('jti')->value());
  }
}
