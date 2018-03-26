<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime\Timestamp;

final class TimestampStruct
  implements Timestamp {
  /** @var int */
  private $seconds;

  public function __construct(int $seconds) {
    if ($seconds < 0) {
      throw new \InvalidArgumentException('Unix timestamp must be non-negative.');
    }
    $this->seconds = $seconds;
  }

  public function seconds(): int {
    return $this->seconds;
  }
}
