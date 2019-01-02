<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache;

use Xtuple\Util\Cache\Record\Record;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\Postgres\Cache\Key\PostgresKeyFromKey;
use Xtuple\Util\Postgres\Cache\Record\PostgresRecordFromRecord;
use Xtuple\Util\Postgres\Database;
use Xtuple\Util\Postgres\PDO\Query\Parameter\Table\Table;
use Xtuple\Util\Postgres\Query\QueryWithTokens;
use Xtuple\Util\Postgres\Transaction\Transaction;

final class InsertRecordTransaction
  implements Transaction {
  /** @var Record */
  private $record;
  /** @var Table */
  private $table;

  public function __construct(Record $record, Table $table) {
    $this->record = $record;
    $this->table = $table;
  }

  /**
   * @throws Throwable
   *
   * @param Database $database
   *
   * @return PostgresRecordFromRecord
   */
  public function run(Database $database) {
    $postgresRecord = new PostgresRecordFromRecord($this->record);
    /** @noinspection NullPointerExceptionInspection */
    $exists = $database->query(new QueryWithTokens('SELECT count(*) FROM %table WHERE cid = :cid', [
        'table' => $this->table,
      ], [
        ':cid' => (new PostgresKeyFromKey($this->record->key()))->id(),
      ]))->rows()->get(0)->get('count') !== 0;
    if ($exists) {
      $query = '
        UPDATE %table 
        SET data = :data, expire = :expire, created = :created, serialized = :serialized
        WHERE cid = :cid
      ';
    }
    else {
      $query = '
        INSERT INTO %table (cid, data, expire, created, serialized) 
        VALUES (:cid, :data, :expire, :created, :serialized)
      ';
    }
    $database->query(new QueryWithTokens($query, [
      'table' => $this->table,
    ], $postgresRecord->row()));
    return $postgresRecord;
  }
}
