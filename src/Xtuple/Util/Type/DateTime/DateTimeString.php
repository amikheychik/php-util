<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

final class DateTimeString
  extends AbstractDateTime {
  /**
   * @throws \Throwable
   *
   * @param string      $date
   * @param null|string $timezone
   */
  public function __construct(string $date = 'now', ?string $timezone = null) {
    parent::__construct(new DateTimeStruct(
      new \DateTimeImmutable(
        $date,
        $timezone ? new \DateTimeZone($timezone) : null
      )
    ));
  }
}
