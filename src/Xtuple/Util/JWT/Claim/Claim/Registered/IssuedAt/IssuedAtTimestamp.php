<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt;

use Xtuple\Util\Type\DateTime\DateTimeTimestamp;
use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

final class IssuedAtTimestamp
  extends AbstractIssuedAt {
  public function __construct(Timestamp $timestamp) {
    parent::__construct(new IssuedAtStruct(
      new DateTimeTimestamp($timestamp)
    ));
  }
}
