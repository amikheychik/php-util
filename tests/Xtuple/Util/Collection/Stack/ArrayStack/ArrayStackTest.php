<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Stack\ArrayStack;

use PHPUnit\Framework\TestCase;

class ArrayStackTest
  extends TestCase {
  public function testStack() {
    $stack = new ArrayStack();
    self::assertEquals(0, $stack->count());
    self::assertEquals(1, $stack->push('one'));
    self::assertEquals('one', $stack->pop());
    self::assertTrue($stack->isEmpty());
    $stack->push(1);
    $stack->push(2);
    $stack->push(3);
    $i = 0;
    foreach ($stack as $key => $value) {
      self::assertEquals($i, $key);
      self::assertEquals(++$i, $value);
    }
    self::assertEquals(3, $stack->count());
    self::assertFalse($stack->isEmpty());
  }
}
