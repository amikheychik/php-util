<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence\ArrayList;

use PHPUnit\Framework\TestCase;

class ArrayListTest
  extends TestCase {
  public function testList() {
    $list = new ArrayList();
    self::assertEquals(0, $list->count());
    self::assertTrue($list->isEmpty());
    $list = new ArrayList([1, 2, 3]);
    self::assertEquals(3, $list->count());
    self::assertFalse($list->isEmpty());
    self::assertNull($list->get(3));
    self::assertEquals(3, $list->get(2));
    $i = 0;
    foreach ($list as $key => $value) {
      self::assertEquals($i, $key);
      self::assertEquals($i + 1, $value);
      $i++;
    }
  }
}
