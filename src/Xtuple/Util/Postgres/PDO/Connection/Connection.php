<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Connection;

interface Connection
  extends \Serializable {
  /**
   * @see https://secure.php.net/manual/en/ref.pdo-pgsql.connection.php
   * @return string
   */
  public function dsn(): string;
}
