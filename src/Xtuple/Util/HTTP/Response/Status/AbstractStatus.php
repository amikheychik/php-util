<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status;

abstract class AbstractStatus
  implements Status {
  /** @var Status */
  private $status;

  public function __construct(Status $status) {
    $this->status = $status;
  }

  public final function __toString(): string {
    return $this->status->__toString();
  }

  public final function version(): string {
    return $this->status->version();
  }

  public final function code(): int {
    return $this->status->code();
  }

  public final function reason(): string {
    return $this->status->reason();
  }
}
