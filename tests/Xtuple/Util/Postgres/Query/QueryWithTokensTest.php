<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query;

use PHPUnit\Framework\TestCase;

class QueryWithTokensTest
  extends TestCase {
  public function testConstructor() {
    $query = new QueryWithTokens("CREATE USER %user WITH PASSWORD '%password'", [
      'user' => 'phpunit',
      'password' => 'phpunit',
    ]);
    self::assertEquals("CREATE USER phpunit WITH PASSWORD 'phpunit'", $query->sql());
    self::assertEquals([], $query->parameters());
    $query = new QueryWithTokens('SELECT FROM %table WHERE id = :id', [
      'table' => 'phpunit',
    ], [
      ':id' => 1,
    ]);
    self::assertEquals('SELECT FROM phpunit WHERE id = :id', $query->sql());
    self::assertEquals([':id' => 1], $query->parameters());
  }
}
