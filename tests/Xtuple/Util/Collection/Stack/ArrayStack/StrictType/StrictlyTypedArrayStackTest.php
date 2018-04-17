<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Stack\ArrayStack\StrictType;

use PHPUnit\Framework\TestCase;

class StrictlyTypedArrayStackTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage All elements must be \stdClass. Element 0 of type \array given.
   * @throws \Throwable
   */
  public function testConstructor() {
    new StrictlyTypedArrayStack(\stdClass::class);
    new StrictlyTypedArrayStack(\stdClass::class, [
      (object) ['name' => 'one'],
    ]);
    new StrictlyTypedArrayStack(\stdClass::class, [
      ['name' => 'one'],
    ]);
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage array is passed, \stdClass is required
   * @throws \Throwable
   */
  public function testStack() {
    $stack = new StrictlyTypedArrayStack(\stdClass::class);
    self::assertEquals(0, $stack->count());
    self::assertEquals(1, $stack->push((object) ['name' => 'one']));
    self::assertEquals((object) ['name' => 'one'], $stack->pop());
    self::assertTrue($stack->isEmpty());
    $stack->push((object) ['key' => 1]);
    $stack->push((object) ['key' => 2]);
    $stack->push((object) ['key' => 3]);
    $i = 0;
    foreach ($stack as $key => $value) {
      self::assertEquals($i, $key);
      self::assertEquals($i + 1, $value->key);
      $i += 1;
    }
    self::assertEquals(3, $stack->count());
    self::assertFalse($stack->isEmpty());
    $stack->push(['key' => 'test']);
  }
}
