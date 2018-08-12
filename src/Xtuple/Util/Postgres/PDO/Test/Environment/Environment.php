<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Test\Environment;

use Xtuple\Util\Postgres\PDO\Connection\Connection;
use Xtuple\Util\Postgres\PDO\PDODatabase;

interface Environment {
  public function connection(): Connection;

  public function database(): PDODatabase;
}
