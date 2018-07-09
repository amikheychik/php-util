<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Generics\Type\Exception\TypeThrowable;

class TypeTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testScalar() {
    $type = new ScalarType();
    self::assertEquals('string', $type->cast('string'));
    self::assertEquals(0.0, $type->cast(0.0));
    self::assertEquals(0, $type->cast(0));
    self::assertTrue($type->cast(true));
    self::assertFalse($type->cast(false));
    $this->expectException(TypeThrowable::class);
    $this->expectExceptionMessage('Value must be of the type scalar, instance of array given');
    /** @noinspection PhpParamsInspection - causing an error to test */
    $type->cast([]);
  }

  /**
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
    $this->expectException(TypeThrowable::class);
    $this->expectExceptionMessage('Value must be of the type scalar, instance of object given');
    $type->cast(new \stdClass());
  }

  /**
   * @throws \Throwable
   */
  public function testStrict() {
    $stdClass = new StrictType(\Countable::class);
    $instance1 = new \ArrayObject();
    self::assertInstanceOf(\ArrayObject::class, $stdClass->cast($instance1));
    $instance2 = $stdClass->cast($instance1);
    self::assertSame($instance1, $instance2);
    $this->expectException(TypeThrowable::class);
    $this->expectExceptionMessage('Value must be of the type Countable, instance of NULL given');
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
   * @throws \Throwable
   */
  public function testNonObjectValidation() {
    $stdClass = new NullableType(\ArrayObject::class);
    $this->expectException(TypeThrowable::class);
    $this->expectExceptionMessage('Value must be of the type ArrayObject, instance of array given');
    $stdClass->cast([]);
  }

  /**
   * @throws \Throwable
   */
  public function testInstanceOfValidation() {
    $stdClass = new NullableType(\Countable::class);
    $stdClass->cast(new \ArrayObject());
    $this->expectException(TypeThrowable::class);
    $this->expectExceptionMessage('Value must be of the type Countable, instance of stdClass given');
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
    catch (TypeThrowable $e) {
      self::assertEquals('Value must be of the type string, instance of array given', $e->getMessage());
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed to throw cast exception');
      }
      unset($e);
    }
    $type = new CastType((object) []);
    $instance = (object) ['test' => 'instance'];
    self::assertEquals(\stdClass::class, $type->fqn());
    self::assertEquals($instance, $type->cast($instance));
    try {
      $type->cast(['standard' => 'class']);
    }
    catch (TypeThrowable $e) {
      self::assertEquals('Value must be of the type stdClass, instance of array given', $e->getMessage());
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed to throw cast exception');
      }
      unset($e);
    }
  }

  /**
   * @throws \Throwable
   */
  public function testResource() {
    $type = new ResourceType();
    $temp = tmpfile();
    self::assertSame($temp, $type->cast($temp));
    try {
      $type->cast(null);
    }
    catch (TypeThrowable $e) {
      self::assertEquals('Value must be of the type resource, instance of NULL given', $e->getMessage());
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed to throw an ArgumentTypeThrowable');
      }
      unset($e);
    }
  }
}
