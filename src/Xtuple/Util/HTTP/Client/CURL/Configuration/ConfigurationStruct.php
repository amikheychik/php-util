<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Configuration;

final class ConfigurationStruct
  implements Configuration {
  /** @var bool */
  private $debug;
  /** @var float */
  private $timeout;

  public function __construct(bool $debug, float $timeout) {
    $this->debug = $debug;
    $this->timeout = $timeout;
  }

  public function debug(): bool {
    return $this->debug;
  }

  public function timeout(): float {
    return $this->timeout;
  }
}
