<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Postgres\PDO\Query\Result\Row\RowStdClass;

class ArrayListRowTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $rows = [];
    $list = new class (new ArrayListRow($rows))
      extends AbstractListRow {
    };
    self::assertTrue($list->isEmpty());
    $rows = [
      new RowStdClass((object) ['id' => 1, 'name' => 'xTuple']),
      new RowStdClass((object) ['id' => 2, 'name' => 'xTuple University']),
      new RowStdClass((object) ['id' => 3, 'name' => 'xTuple Commerce']),
    ];
    /** @var ListRow $list */
    $list = new class (new ArrayListRow($rows))
      extends AbstractListRow {
    };
    self::assertFalse($list->isEmpty());
    self::assertNull($list->get(3));
    self::assertEquals(3, $list->get(2)->get('id'));
  }
}
