<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

use Xtuple\Util\Exception\Exception;

final class DateTimeTimestamp
  extends AbstractDateTime {
  /**
   * @throws \Throwable
   *
   * @param int $timestamp
   */
  public function __construct(int $timestamp) {
    if ($timestamp < 0) {
      throw new Exception('Unix timestamp must be non-negative.');
    }
    /** @noinspection PhpUnhandledExceptionInspection - known format would be parsed correctly */
    parent::__construct(new DateTimeStruct(
      new \DateTimeImmutable(
        date('Y-m-d\TH:i:s', $timestamp)
      )
    ));
  }
}
