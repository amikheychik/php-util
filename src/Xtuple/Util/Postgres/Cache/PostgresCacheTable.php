<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache;

use Xtuple\Util\Cache\Cache;
use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\Cache\Record\Record;
use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\Postgres\Cache\Key\PostgresKeyFromKey;
use Xtuple\Util\Postgres\Cache\Record\PDO\RecordRow;
use Xtuple\Util\Postgres\Cache\Record\PostgresRecordFromRecord;
use Xtuple\Util\Postgres\PDO\Connection\Connection;
use Xtuple\Util\Postgres\PDO\PDODatabase;
use Xtuple\Util\Postgres\PDO\Query\Parameter\Table\Table;
use Xtuple\Util\Postgres\Query\QueryStruct;

final class PostgresCacheTable
  implements Cache {
  /** @var Connection */
  private $connection;
  /** @var Table */
  private $table;
  /** @var int - timestamp consistent across any calls for this cache */
  private $now;

  public function __construct(Connection $connection, Table $table) {
    $this->connection = $connection;
    $this->table = $table;
    $this->now = time();
  }

  public function serialize() {
    return serialize([
      'connection' => $this->connection,
      'table' => $this->table,
    ]);
  }

  public function unserialize($serialized) {
    $data = unserialize($serialized, ['allowed_classes' => true]);
    $this->__construct($data['connection'], $data['table']);
  }

  public function find(Key $key): ?Record {
    try {
      if ($row = $this->database()->query(new QueryStruct("
        SELECT * 
        FROM {$this->table} 
        WHERE cid = :cid 
          AND (expire = 0 OR expire > :now)
      ", [
        ':cid' => (new PostgresKeyFromKey($key))->id(),
        ':now' => $this->now,
      ]))->rows()->get(0)) {
        return (new RecordRow($row))->record($key);
      }
    }
    catch (\Throwable $e) {
    }
    return null;
  }

  /**
   * @throws \Throwable
   */
  public function clear(): void {
    $this->database()->query(new QueryStruct("TRUNCATE {$this->table}"));
  }

  /**
   * @throws \Throwable
   *
   * @param Key $key
   */
  public function delete(Key $key): void {
    try {
      $this->database()->query(new QueryStruct("DELETE FROM {$this->table} WHERE cid LIKE :cid", [
        ':cid' => (new PostgresKeyFromKey($key))->id(),
      ]));
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Can not delete cache record {id} from Postgres table {table}', [
        'id' => (new PostgresKeyFromKey($key))->id(),
        'table' => $this->table,
      ]);
    }
  }

  /**
   * @return PostgresRecordFromRecord
   *
   * @param Record $record
   *
   * @throws Throwable
   */
  public function insert(Record $record) {
    try {
      return $this->database()->transaction(
        new InsertRecordTransaction($record, $this->table)
      );
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Can not write cache record {cid} into Postgres table {table}', [
        'cid' => (new PostgresKeyFromKey($record->key()))->id(),
        'table' => $this->table,
      ]);
    }
  }

  /**
   * @throws \Throwable
   * @return bool
   */
  public function isEmpty(): bool {
    /** @noinspection NullPointerExceptionInspection */
    return $this->database()->query(new QueryStruct("
        SELECT count(*) 
        FROM {$this->table}
        WHERE (expire = 0 OR expire > :now)
      ", [
        ':now' => $this->now,
      ]))->rows()->get(0)->get('count') === 0;
  }

  /** @var PDODatabase|null */
  private $database;

  private function database(): PDODatabase {
    if ($this->database === null) {
      $this->database = new PDODatabase($this->connection);
    }
    return $this->database;
  }
}
