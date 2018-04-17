<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Collection\Set\ArraySet\ArraySet;

class SetTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testSet() {
    $set = new TestSet(new ArraySet());
    self::assertTrue($set->isEmpty());
    self::assertEquals(0, $set->count());
    $set = new TestSet(new ArraySet([1 => 'one']));
    self::assertFalse($set->isEmpty());
    self::assertEquals(1, $set->count());
    self::assertEquals('one', $set->get('1'));
    foreach ($set as $key => $value) {
      self::assertEquals(1, $key);
      self::assertEquals('one', $value);
    }
  }
}

class TestSet
  extends AbstractSet {
}
