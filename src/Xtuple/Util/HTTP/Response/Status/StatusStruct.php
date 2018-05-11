<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status;

final class StatusStruct
  implements Status {
  /** @var string */
  private $version;
  /** @var int */
  private $code;
  /** @var string */
  private $reason;

  public function __construct(string $version, int $code, string $reason) {
    $this->version = $version;
    $this->code = $code;
    $this->reason = $reason;
  }

  public function __toString(): string {
    return "HTTP/{$this->version} {$this->code} {$this->reason}";
  }

  public function version(): string {
    return $this->version;
  }

  public function code(): int {
    return $this->code;
  }

  public function reason(): string {
    return $this->reason;
  }
}
