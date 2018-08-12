<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Test\Environment\Configuration;

use Xtuple\Util\Postgres\PDO\Connection\Connection;

abstract class AbstractConfiguration
  implements Configuration {
  /** @var Configuration */
  private $environment;

  public function __construct(Configuration $environment) {
    $this->environment = $environment;
  }

  public final function postgres(): Connection {
    return $this->environment->postgres();
  }
}
