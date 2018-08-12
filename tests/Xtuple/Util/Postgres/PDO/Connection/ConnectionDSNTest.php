<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Connection;

use PHPUnit\Framework\TestCase;

class ConnectionDSNTest
  extends TestCase {
  public function testConstructor() {
    $connection = new ConnectionDSN('pgsql:host=localhost;port=5432;dbname=db;user=user;password=pass');
    self::assertEquals('pgsql:host=localhost;port=5432;dbname=db;user=user;password=pass', $connection->dsn());
    $connection = new ConnectionDSN('pgsql:host=localhost;dbname=db;user=user');
    self::assertEquals('pgsql:host=localhost;dbname=db;user=user', $connection->dsn());
    $connection = new ConnectionDSN('pgsql:');
    self::assertEquals('pgsql:', $connection->dsn());
  }

  public function testSerialization() {
    $connection = new ConnectionDSN('pgsql:host=localhost;port=5432;dbname=db;user=user;password=pass');
    $serialized = serialize($connection);
    self::assertEquals(
      'C:49:"Xtuple\Util\Postgres\PDO\Connection\ConnectionDSN":64:{pgsql:host=localhost;port=5432;dbname=db;user=user;password=pass}',
      $serialized
    );
    $unserialized = unserialize($serialized);
    self::assertEquals(
      'pgsql:host=localhost;port=5432;dbname=db;user=user;password=pass',
      $unserialized->dsn()
    );
  }
}
