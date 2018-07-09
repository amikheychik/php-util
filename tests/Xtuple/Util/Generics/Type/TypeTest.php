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
    self::assertSame($instance1, $instance2);
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
    $stdClass = new NullableType(\Countable::class);
    $stdClass->cast(new \ArrayObject());
    $stdClass->cast(new \stdClass());
  }

  /**
   * @throws \Throwable
   */
  public function testCastType() {
    $type = new CastType('array');
    self::assertEquals('string', $type->fqn());
    self::assertEquals('casted', $type->cast('casted'));
    try {
      $type->cast(['casted']);
    }
    catch (\Throwable $e) {
      self::assertEquals('array is passed, string is required', $e->getMessage());
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed to throw cast exception');
      }
      unset($e);
    }
    $type = new CastType((object) []);
    $instance = (object) ['test' => 'instance'];
    self::assertEquals(\stdClass::class, ltrim($type->fqn(), '\\'));
    self::assertEquals($instance, $type->cast($instance));
    try {
      $type->cast(['standard' => 'class']);
    }
    catch (\Throwable $e) {
      self::assertEquals('array is passed, \stdClass is required', $e->getMessage());
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed to throw cast exception');
      }
      unset($e);
    }
  }
}
