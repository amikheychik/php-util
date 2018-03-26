<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

final class DateTimeTimestamp
  extends AbstractDateTime {
  public function __construct(int $timestamp) {
    if ($timestamp < 0) {
      throw new \InvalidArgumentException('Unix timestamp must be non-negative.');
    }
    parent::__construct(new DateTimeStruct(
      new \DateTimeImmutable(
        date('Y-m-d\TH:i:s', $timestamp)
      )
    ));
  }
}
