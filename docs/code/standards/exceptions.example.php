<?php
/** @noinspection UnusedConstructorDependenciesInspection */
/** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Exception;

final class Exceptional {
  /** @var \DateTimeImmutable */
  private $now;
  /** @var string */
  private $connection;

  public function __construct(string $connection) {
    /** @noinspection PhpUnhandledExceptionInspection - 'now' value is a default argument value */ // <1>
    $this->now = new \DateTimeImmutable('now');
    $this->connection = $connection;
  }

  /** @var null|\PDO */
  private $pdo;

  /**
   * @throws \Throwable // <2>
   * @return \PDO
   */
  public function pdo(): \PDO {
    if ($this->pdo === null) {
      $this->pdo = new \PDO($this->connection);
    }
    return $this->pdo;
  }

  /**
   * @throws \Throwable // <3>
   *
   * @param string $query
   * @param array  $params
   *
   * @return \stdClass
   */
  public function execute(string $query, array $params = []): \stdClass {
    $statement = $this->pdo()->prepare($query);
    if ($statement === false) {
      throw new Exception('Failed to prepare a PDO statement');
    }
    /** @var \PDOStatement $statement */
    if (!$statement->execute($params)) {
      throw new Exception('Failed to execute a PDO statement');
    }
    $result = $statement->fetchObject();
    if ($result === false) {
      throw new Exception('Failed to fetch an object from a PDO statement');
    }
    return $result; // <4>
  }

  public function has(int $id): bool {
    try {
      return (bool) $this->execute('SELECT EXISTS(SELECT 1 FROM example WHERE id = :id) AS result;', [
        ':id' => $id,
      ])->result;
    }
    catch (\Throwable $e) { // <5>
    }
    return false;
  }

  /**
   * @throws \Throwable // <6>
   *
   * @param int $id
   *
   * @return \stdClass
   */
  public function get(int $id): \stdClass {
    try {
      return $this->execute('SELECT * FROM example WHERE id = :id', [':id' => $id]);
    }
    catch (\Throwable $e) { // <7>
      throw new ChainException($e, 'Failed to load object {id}', [
        'id' => $id,
      ]);
    }
  }
}
