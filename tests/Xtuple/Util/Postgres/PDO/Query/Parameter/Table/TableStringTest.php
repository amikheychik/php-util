<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Query\Parameter\Table;

use PHPUnit\Framework\TestCase;

class TableStringTest
  extends TestCase {
  /**
   * @expectedException \Xtuple\Util\Exception\Throwable
   * @expectedExceptionMessage Postgres table can not have `* FROM users; SELECT` name
   * @throws \Throwable
   */
  public function testConstructorException() {
    new TableString('* FROM users; SELECT');
  }
}
