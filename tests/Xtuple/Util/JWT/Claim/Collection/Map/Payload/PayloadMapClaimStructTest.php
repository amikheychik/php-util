<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Payload;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\JWT\Claim\Claim\Registered\Audience\AudienceStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\ExpirationTime\ExpirationTimeStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt\IssuedAtStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Issuer\IssuerStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\JWTID\JWTIDStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\NotBefore\NotBeforeStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Subject\SubjectStruct;
use Xtuple\Util\JWT\Claim\ClaimStruct;
use Xtuple\Util\JWT\Claim\Collection\Map\ArrayMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Registered\RegisteredMapClaimStruct;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class PayloadMapClaimStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $now = time();
    $claims = new class (new PayloadMapClaimStruct(
      new RegisteredMapClaimStruct(
        new IssuerStruct('issuer'),
        new SubjectStruct('subject'),
        new AudienceStruct('audience'),
        new IssuedAtStruct(new DateTimeTimestampSeconds($now)),
        new ExpirationTimeStruct(new DateTimeTimestampSeconds($now + 3600)),
        new NotBeforeStruct(new DateTimeTimestampSeconds($now)),
        new JWTIDStruct('jwt_id')
      ),
      new ArrayMapClaim([
        new ClaimStruct('pub', 'public'),
      ]),
      new ArrayMapClaim([
        new ClaimStruct('pub', 'protected'),
        new ClaimStruct('prv', 'private'),
      ])
    ))
      extends AbstractPayloadMapClaim {
    };
    self::assertEquals(9, $claims->count());
    self::assertEquals(7, $claims->registered()->count());
    self::assertEquals(1, $claims->public()->count());
    self::assertEquals(2, $claims->private()->count());
    self::assertEquals('public', $claims->public()->get('pub')->value());
    self::assertEquals('protected', $claims->private()->get('pub')->value());
    self::assertEquals('protected', $claims->get('pub')->value());
    self::assertEquals('private', $claims->get('prv')->value());
  }
}
