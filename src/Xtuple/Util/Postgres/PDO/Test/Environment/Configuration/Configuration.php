<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Test\Environment\Configuration;

use Xtuple\Util\Postgres\PDO\Connection\Connection;

interface Configuration
  extends \Xtuple\Util\Test\Environment\Configuration\Configuration {
  public function postgres(): Connection;
}
