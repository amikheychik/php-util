<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use PHPUnit\Framework\TestCase;

class TypeTest
  extends TestCase {
  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage NULL is passed, \Countable is required
   */
  public function testStrict() {
    $stdClass = new StrictType(\Countable::class);
    $instance1 = new \ArrayObject();
    self::assertInstanceOf(\ArrayObject::class, $stdClass->cast($instance1));
    $instance2 = $stdClass->cast($instance1);
    self::assertTrue($instance1 === $instance2);
    $stdClass->cast(null);
  }

  public function testNullable() {
    $stdClass = new NullableType(\ArrayObject::class);
    self::assertInstanceOf(\ArrayObject::class, $stdClass->cast(new \ArrayObject()));
    self::assertNull($stdClass->cast(null));
  }

  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage array is passed, \ArrayObject is required
   */
  public function testNonObjectValidation() {
    $stdClass = new NullableType(\ArrayObject::class);
    $stdClass->cast([]);
  }

  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage \stdClass is passed, \Countable is required
   */
  public function testInstanceOfValidation() {
    $stdClass = new NullableType('\Countable');
    $stdClass->cast(new \ArrayObject());
    $stdClass->cast(new \stdClass());
  }
}
