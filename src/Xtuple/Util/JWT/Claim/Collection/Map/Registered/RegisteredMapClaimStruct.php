<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Registered;

use Xtuple\Util\JWT\Claim\Claim\Registered\Audience\Audience;
use Xtuple\Util\JWT\Claim\Claim\Registered\ExpirationTime\ExpirationTime;
use Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt\IssuedAt;
use Xtuple\Util\JWT\Claim\Claim\Registered\Issuer\Issuer;
use Xtuple\Util\JWT\Claim\Claim\Registered\JWTID\JWTID;
use Xtuple\Util\JWT\Claim\Claim\Registered\NotBefore\NotBefore;
use Xtuple\Util\JWT\Claim\Claim\Registered\Subject\Subject;
use Xtuple\Util\JWT\Claim\Collection\Map\AbstractMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\ArrayMapClaim;

/**
 * Class RegisteredMap<Claim>Struct - Registered claims
 */
final class RegisteredMapClaimStruct
  extends AbstractMapClaim
  implements RegisteredMapClaim {
  public function __construct(?Issuer $issuer = null, ?Subject $subject = null, ?Audience $audience = null,
                              ?IssuedAt $issuedAt = null, ?ExpirationTime $expirationTime = null,
                              ?NotBefore $notBefore = null, ?JWTID $jwtID = null) {
    /** @noinspection PhpUnhandledExceptionInspection */
    parent::__construct(new ArrayMapClaim(array_filter([
      $issuer,
      $subject,
      $audience,
      $issuedAt,
      $expirationTime,
      $notBefore,
      $jwtID,
    ])));
  }
}
