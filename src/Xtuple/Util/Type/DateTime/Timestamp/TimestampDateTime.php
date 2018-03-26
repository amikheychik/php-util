<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime\Timestamp;

use Xtuple\Util\Type\DateTime\DateTime;

final class TimestampDateTime
  extends AbstractTimestamp {
  public function __construct(DateTime $dateTime) {
    parent::__construct(new TimestampStruct(
      (new \DateTimeImmutable($dateTime->utc()))->getTimestamp()
    ));
  }
}
