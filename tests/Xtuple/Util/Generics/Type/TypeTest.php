<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use PHPUnit\Framework\TestCase;

class TypeTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage array is passed, scalar is required
   * @throws \Throwable
   */
  public function testScalar() {
    $type = new ScalarType();
    self::assertEquals('string', $type->cast('string'));
    self::assertEquals(0.0, $type->cast(0.0));
    self::assertEquals(0, $type->cast(0));
    self::assertTrue($type->cast(true));
    self::assertFalse($type->cast(false));
    /** @noinspection PhpParamsInspection - causing an error to test */
    $type->cast([]);
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage object is passed, scalar is required
   * @throws \Throwable
   */
  public function testNullableScalar() {
    $type = new NullableScalarType();
    self::assertEquals('string', $type->cast('string'));
    self::assertEquals(0.0, $type->cast(0.0));
    self::assertEquals(0, $type->cast(0));
    self::assertTrue($type->cast(true));
    self::assertFalse($type->cast(false));
    self::assertNull($type->cast(null));
    $type->cast(new \stdClass());
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage NULL is passed, \Countable is required
   * @throws \Throwable
   */
  public function testStrict() {
    $stdClass = new StrictType(\Countable::class);
    $instance1 = new \ArrayObject();
    self::assertInstanceOf(\ArrayObject::class, $stdClass->cast($instance1));
    $instance2 = $stdClass->cast($instance1);
    self::assertTrue($instance1 === $instance2);
    $stdClass->cast(null);
  }

  /**
   * @throws \Throwable
   */
  public function testNullableType() {
    $stdClass = new NullableType(\ArrayObject::class);
    self::assertInstanceOf(\ArrayObject::class, $stdClass->cast(new \ArrayObject()));
    self::assertNull($stdClass->cast(null));
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage array is passed, \ArrayObject is required
   * @throws \Throwable
   */
  public function testNonObjectValidation() {
    $stdClass = new NullableType(\ArrayObject::class);
    $stdClass->cast([]);
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage \stdClass is passed, \Countable is required
   * @throws \Throwable
   */
  public function testInstanceOfValidation() {
    $stdClass = new NullableType('\Countable');
    $stdClass->cast(new \ArrayObject());
    $stdClass->cast(new \stdClass());
  }
}
