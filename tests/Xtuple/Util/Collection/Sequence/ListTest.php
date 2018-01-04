<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Collection\Sequence\ArrayList\ArrayList;

class ListTest
  extends TestCase {
  public function testList() {
    $list = new TestList(new ArrayList());
    self::assertEquals(0, $list->count());
    self::assertTrue($list->isEmpty());
    $list = new TestList(new ArrayList([1, 2, 3]));
    self::assertEquals(3, $list->count());
    self::assertFalse($list->isEmpty());
    self::assertNull($list->get(3));
    $i = 0;
    foreach ($list as $key => $value) {
      self::assertEquals($i, $key);
      self::assertEquals($i + 1, $value);
      $i++;
    }
  }
}

class TestList
  extends AbstractList {
}
