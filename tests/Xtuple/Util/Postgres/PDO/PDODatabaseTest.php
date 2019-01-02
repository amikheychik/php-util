<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO;

use Xtuple\Util\Postgres\PDO\Connection\ConnectionStruct;
use Xtuple\Util\Postgres\PDO\Test\PDODatabaseTestCase;
use Xtuple\Util\Postgres\Query\QueryStruct;

final class PDODatabaseTest
  extends PDODatabaseTestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage [42P07] ERROR:  relation "test_database" already exists
   * @throws \Throwable
   */
  public function testSerialization() {
    $connection = new ConnectionStruct('localhost', 5432, 'db', 'user', 'pass');
    $db = new PDODatabase($connection);
    self::assertEquals(
      'C:36:"Xtuple\Util\Postgres\PDO\PDODatabase":92:{C:52:"Xtuple\Util\Postgres\PDO\Connection\ConnectionStruct":27:{localhost;5432;db;user;pass}}',
      serialize($db)
    );
    /** @var PDODatabase $unserialized */
    $unserialized = unserialize(serialize($this->environment->database()));
    $unserialized->query(new QueryStruct('DROP TABLE IF EXISTS test_database'));
    $unserialized->query(new QueryStruct('
      CREATE TEMPORARY TABLE test_database (
        id SERIAL PRIMARY KEY NOT null
      )
    '));
    $unserialized->query(new QueryStruct('
      CREATE TEMPORARY TABLE test_database (
        id SERIAL PRIMARY KEY NOT null
      )
    '));
  }

  /**
   * @throws \Throwable
   */
  public function testQuery() {
    $db = $this->environment->database();
    $db->query(new QueryStruct('DROP TABLE IF EXISTS test_database;'));
    $db->query(new QueryStruct("
      CREATE TEMPORARY TABLE test_database (
        id serial PRIMARY KEY NOT NULL,
        name varchar(255) DEFAULT ''::character
      )
    "));
    $db->query(new QueryStruct('CREATE INDEX test_database_name_index ON test_database (name)'));
    $db->query(new QueryStruct("INSERT INTO test_database (name) VALUES ('Record 1')"));
    $db->query(new QueryStruct("INSERT INTO test_database (name) VALUES ('Record 2')"));
    $records = $db->query(new QueryStruct('SELECT * FROM test_database'))->rows();
    foreach ($records as $i => $record) {
      self::assertEquals($i + 1, $record->get('id'));
      self::assertEquals("Record {$record->get('id')}", $record->get('name'));
    }
  }
}
