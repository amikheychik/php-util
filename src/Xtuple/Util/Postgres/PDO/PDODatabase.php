<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Postgres\Database;
use Xtuple\Util\Postgres\PDO\Connection\Connection;
use Xtuple\Util\Postgres\PDO\Query\Result\ResultOfStatement;
use Xtuple\Util\Postgres\Query\Query;
use Xtuple\Util\Postgres\Query\Result\Result;
use Xtuple\Util\Postgres\Transaction\Transaction;

final class PDODatabase
  implements Database {
  /** @var Connection */
  private $connection;

  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  public function serialize() {
    return serialize($this->connection);
  }

  public function unserialize($serialized) {
    $this->connection = unserialize($serialized, ['allowed_classes' => true]);
  }

  public function query(Query $query): Result {
    try {
      $statement = $this->pdo()->prepare($query->sql());
      $statement->execute($query->parameters());
      return new ResultOfStatement($statement);
    }
    catch (\Throwable $e) {
      $message = 'Failed database query';
      $parameters = [];
      $code = 0;
      if (isset($statement)) {
        $message = 'Failed database query: [{code}] {message}';
        $parameters = [
          'code' => $statement->errorCode(),
          'message' => $statement->errorInfo()[2],
        ];
        $code = (int) $statement->errorCode();
      }
      throw new ChainException($e, $message, $parameters, null, $code);
    }
  }

  public function transaction(Transaction $transaction) {
    try {
      $this->pdo()->beginTransaction();
      $result = $transaction->run($this);
      $this->pdo()->commit();
      return $result;
    }
    catch (\Throwable $e) {
      $this->pdo()->rollBack();
      throw new ChainException($e, 'Failed transaction');
    }
  }

  /** @var null|\PDO */
  private $pdo;

  private function pdo(): \PDO {
    if ($this->pdo === null) {
      $this->pdo = new \PDO($this->connection->dsn());
      $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    return $this->pdo;
  }
}
