<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence\ArrayListRow;

class ResultStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $rows = new ArrayListRow();
    $result = new class (new ResultStruct($rows, 42))
      extends AbstractResult {
    };
    self::assertSame($rows, $result->rows());
    self::assertEquals(42, $result->affected());
  }
}
