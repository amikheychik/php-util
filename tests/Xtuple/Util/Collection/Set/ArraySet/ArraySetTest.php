<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set\ArraySet;

use PHPUnit\Framework\TestCase;

class ArraySetTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Element 1 is duplicated
   * @throws \Throwable
   */
  public function testConstructor() {
    new ArraySet();
    new ArraySet([1 => 'one', 2 => 'two', 3 => 'three']);
    new ArraySet([1, 2, 3], function ($element) {
      return $element;
    });
    new ArraySet([1, 2, 1], function ($element) {
      return $element;
    });
  }

  /**
   * @throws \Throwable
   */
  public function testSet() {
    $set = new ArraySet();
    self::assertTrue($set->isEmpty());
    self::assertEquals(0, $set->count());
    $set = new ArraySet([1 => 1, 2 => 2, 3 => 3]);
    self::assertEquals(3, $set->get('3'));
    self::assertFalse($set->isEmpty());
    self::assertEquals(3, $set->count());
    $i = 0;
    foreach ($set as $key => $value) {
      self::assertEquals((string) ($i + 1), $key);
      self::assertEquals($i + 1, $value);
      $i++;
    }
  }
}
