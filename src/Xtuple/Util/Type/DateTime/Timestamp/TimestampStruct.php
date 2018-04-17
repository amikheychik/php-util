<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime\Timestamp;

use Xtuple\Util\Exception\Exception;

final class TimestampStruct
  implements Timestamp {
  /** @var int */
  private $seconds;

  /**
   * @throws \Throwable
   *
   * @param int $seconds
   */
  public function __construct(int $seconds) {
    if ($seconds < 0) {
      throw new Exception('Unix timestamp must be non-negative.');
    }
    $this->seconds = $seconds;
  }

  public function seconds(): int {
    return $this->seconds;
  }
}
