<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set\ArraySet\StrictType;

use PHPUnit\Framework\TestCase;

class StrictlyTypedArrayListTest
  extends TestCase {
  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage array is passed, \stdClass is required
   */
  public function testConstructor() {
    new StrictlyTypedArraySet(\stdClass::class);
    new StrictlyTypedArraySet(\stdClass::class, [
      (object) ['value' => 1],
    ]);
    new StrictlyTypedArraySet(\stdClass::class, [
      ['value' => 1],
    ]);
  }

  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage Method key() is not defined in type \stdClass
   */
  public function testKeyConstructor() {
    new StrictlyTypedArraySet(\stdClass::class, [
      (object) ['value' => 1],
    ], 'key');
  }

  public function testSet() {
    $set = new StrictlyTypedArraySet(TestElement::class);
    self::assertTrue($set->isEmpty());
    self::assertEquals(0, $set->count());
    $set = new StrictlyTypedArraySet(TestElement::class, [
      new TestElement(1),
    ], 'value');
    self::assertFalse($set->isEmpty());
    self::assertEquals(1, $set->count());
    self::assertEquals(null, $set->get('0'));
    self::assertEquals(1, $set->get('1')->value());
    foreach ($set as $key => $value) {
      self::assertEquals('1', $key);
      self::assertEquals(1, $value->value());
    }
  }
}

class TestElement {
  private $value;

  public function __construct($value) {
    $this->value = $value;
  }

  public function value() {
    return $this->value;
  }
}
