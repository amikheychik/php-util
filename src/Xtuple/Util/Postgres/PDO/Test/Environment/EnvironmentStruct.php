<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Test\Environment;

use Xtuple\Util\Postgres\PDO\Connection\Connection;
use Xtuple\Util\Postgres\PDO\PDODatabase;
use Xtuple\Util\Postgres\PDO\Test\Environment\Configuration\Configuration;

final class EnvironmentStruct
  implements Environment {
  /** @var Connection */
  private $connection;
  /** @var PDODatabase */
  private $database;

  public function __construct(Configuration $configuration) {
    $this->connection = $configuration->postgres();
    $this->database = new PDODatabase($configuration->postgres());
  }

  public function connection(): Connection {
    return $this->connection;
  }

  public function database(): PDODatabase {
    return $this->database;
  }
}
