<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Connection;

use PHPUnit\Framework\TestCase;

class ConnectionStructTest
  extends TestCase {
  public function testConstructor() {
    $connection = new ConnectionStruct('localhost', 5432, 'phpunit', 'user', 'password');
    self::assertEquals('pgsql:host=localhost;port=5432;dbname=phpunit;user=user;password=password', $connection->dsn());
    $connection = new ConnectionStruct('localhost', 5432, 'phpunit', 'user', '');
    self::assertEquals('pgsql:host=localhost;port=5432;dbname=phpunit;user=user', $connection->dsn());
    $connection = new ConnectionStruct('', 5432, '', '', '');
    self::assertEquals('pgsql:port=5432', $connection->dsn());
  }

  public function testSerialization() {
    $connection = new ConnectionStruct('localhost', 5432, 'phpunit', 'user', 'password');
    $serialized = serialize($connection);
    self::assertEquals(
      'C:52:"Xtuple\Util\Postgres\PDO\Connection\ConnectionStruct":36:{localhost;5432;phpunit;user;password}',
      $serialized
    );
    $unserialized = unserialize($serialized);
    self::assertEquals('pgsql:host=localhost;port=5432;dbname=phpunit;user=user;password=password', $unserialized->dsn());
    $connection = new ConnectionStruct('', 5432, '', '', '');
    $serialized = serialize($connection);
    self::assertEquals(
      'C:52:"Xtuple\Util\Postgres\PDO\Connection\ConnectionStruct":8:{;5432;;;}',
      $serialized
    );
    $unserialized = unserialize($serialized);
    self::assertEquals('pgsql:port=5432', $unserialized->dsn());
  }
}
