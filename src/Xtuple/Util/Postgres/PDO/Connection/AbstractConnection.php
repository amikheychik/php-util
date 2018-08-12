<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Connection;

abstract class AbstractConnection
  implements Connection {
  /** @var Connection */
  private $connection;

  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  public final function serialize() {
    return serialize($this->connection);
  }

  public final function unserialize($serialized) {
    $this->connection = unserialize($serialized, ['allowed_classes' => true]);
  }

  public final function dsn(): string {
    return $this->connection->dsn();
  }
}
