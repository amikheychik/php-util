<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Connection;

final class ConnectionStruct
  implements Connection {
  /** @var string */
  private $host;
  /** @var int */
  private $port;
  /** @var string */
  private $database;
  /** @var string */
  private $username;
  /** @var string */
  private $password;

  public function __construct(string $host, int $port, string $database, string $username, string $password) {
    $this->host = $host;
    $this->port = $port;
    $this->database = $database;
    $this->username = $username;
    $this->password = $password;
  }

  public function serialize() {
    // `;` is used in DSN, so it's safe to use it as a delimiter
    return implode(';', [
      $this->host,
      $this->port,
      $this->database,
      $this->username,
      $this->password,
    ]);
  }

  public function unserialize($serialized) {
    $data = explode(';', $serialized);
    $this->__construct($data[0], (int) $data[1], $data[2], $data[3], $data[4]);
  }

  public function dsn(): string {
    $connection = array_filter([
      'host' => $this->host,
      'port' => $this->port,
      'dbname' => $this->database,
      'user' => $this->username,
      'password' => $this->password,
    ]);
    $dsn = [];
    foreach ($connection as $parameter => $value) {
      $dsn[] = "{$parameter}={$value}";
    }
    return strtr('pgsql:{connection}', [
      '{connection}' => implode(';', $dsn),
    ]);
  }
}
