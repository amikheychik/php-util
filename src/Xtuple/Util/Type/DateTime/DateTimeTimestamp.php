<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

final class DateTimeTimestamp
  extends AbstractDateTime {
  public function __construct(Timestamp $timestamp) {
    /** @noinspection PhpUnhandledExceptionInspection - known format would be parsed correctly */
    parent::__construct(new DateTimeStruct(
      new \DateTimeImmutable(
        date('Y-m-d\TH:i:s', $timestamp->seconds())
      )
    ));
  }
}
