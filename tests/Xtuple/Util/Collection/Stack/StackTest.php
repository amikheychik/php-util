<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Stack;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Collection\Stack\ArrayStack\ArrayStack;

class StackTest
  extends TestCase {
  public function testStack() {
    $stack = new TestStack(new ArrayStack());
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
      self::assertEquals($i + 1, $value);
      $i += 1;
    }
    self::assertEquals(3, $stack->count());
    self::assertFalse($stack->isEmpty());
  }
}

final class TestStack
  extends AbstractStack {
}
