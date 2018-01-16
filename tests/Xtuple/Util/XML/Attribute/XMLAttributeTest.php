<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute;

use PHPUnit\Framework\TestCase;

class XMLAttributeTest
  extends TestCase {
  public function testStruct() {
    $attribute = new XMLAttributeStruct('name', 'value');
    self::assertEquals('name', $attribute->name());
    self::assertEquals('value', $attribute->value());
    $attribute = new XMLAttributeStruct('bool', true);
    self::assertEquals('bool', $attribute->name());
    self::assertTrue($attribute->value());
  }

  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage Passed element `Test` is not an attribute
   */
  public function testSimpleXML() {
    $simple = new \SimpleXMLElement('<Test name="value" />');
    $attribute = new XMLAttributeSimple($simple->attributes()[0]);
    self::assertEquals('name', $attribute->name());
    self::assertEquals('value', $attribute->value());
    new XMLAttributeSimple($simple);
  }
}
