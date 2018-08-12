<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Connection;

final class ConnectionDSN
  implements Connection {
  /** @var string */
  private $dsn;

  public function __construct(string $dsn) {
    $this->dsn = $dsn;
  }

  public function serialize() {
    return $this->dsn;
  }

  public function unserialize($serialized) {
    $this->__construct($serialized);
  }

  public function dsn(): string {
    return $this->dsn;
  }
}
