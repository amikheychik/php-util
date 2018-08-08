<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime\Timestamp;

final class TimestampNow
  extends AbstractTimestamp {
  public function __construct() {
    /** @noinspection PhpUnhandledExceptionInspection */
    parent::__construct(new TimestampStruct(time()));
  }
}
