<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\ExpirationTime;

use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;
use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

final class LifetimeExpirationTimeFromTimestamp
  extends AbstractExpirationTime {
  public function __construct(Timestamp $issuedAt, int $lifetime) {
    /** @noinspection PhpUnhandledExceptionInspection */
    parent::__construct(new ExpirationTimeStruct(
      new DateTimeTimestampSeconds($issuedAt->seconds() + $lifetime)
    ));
  }
}
