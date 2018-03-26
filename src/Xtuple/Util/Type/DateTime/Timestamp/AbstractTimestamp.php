<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime\Timestamp;

abstract class AbstractTimestamp
  implements Timestamp {
  /** @var Timestamp */
  private $timestamp;

  public function __construct(Timestamp $timestamp) {
    $this->timestamp = $timestamp;
  }

  public final function seconds(): int {
    return $this->timestamp->seconds();
  }
}
