<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\File\File\Regular\Create\CreateRegularFileFromString;

class QueryFileTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $query = new QueryFile(
      new CreateRegularFileFromString('/tmp/phpunit/php-util/query.sql', '
        SELECT *
        FROM %table
        WHERE id = :id
      '),
      [
        'table' => 'phpunit',
      ],
      [
        ':id' => 1,
      ]
    );
    self::assertEquals(
      'SELECT * FROM phpunit WHERE id = :id',
      trim(preg_replace('/[\ \n]+/', ' ', $query->sql()))
    );
    self::assertEquals([
      ':id' => 1,
    ], $query->parameters());
  }

  protected function tearDown() {
    parent::tearDown();
    unlink('/tmp/phpunit/php-util/query.sql');
  }
}
