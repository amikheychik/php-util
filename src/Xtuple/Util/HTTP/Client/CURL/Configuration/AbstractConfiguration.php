<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Configuration;

abstract class AbstractConfiguration
  implements Configuration {
  /** @var Configuration */
  private $configuration;

  public function __construct(Configuration $configuration) {
    $this->configuration = $configuration;
  }

  public final function debug(): bool {
    return $this->configuration->debug();
  }

  public final function timeout(): float {
    return $this->configuration->timeout();
  }
}
