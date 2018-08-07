<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;

final class DateTimeTimestampSeconds
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
    parent::__construct(new DateTimeTimestamp(
      new TimestampStruct($timestamp)
    ));
  }
}
