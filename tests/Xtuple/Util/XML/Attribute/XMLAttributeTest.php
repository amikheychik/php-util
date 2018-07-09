<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute;

use PHPUnit\Framework\TestCase;

class XMLAttributeTest
  extends TestCase {
  public function testStruct() {
    $attribute = new XMLAttributeStruct('name', 'value');
    self::assertEquals('name', $attribute->name());
    self::assertEquals('value', $attribute->value());
    self::assertEquals('name="value"', (string) $attribute);
    $attribute = new XMLAttributeStruct('name', '');
    self::assertEquals('name=""', (string) $attribute);
    $attribute = new XMLAttributeStruct('bool', true);
    self::assertEquals('bool', $attribute->name());
    self::assertTrue($attribute->value());
    self::assertEquals('bool="1"', (string) $attribute);
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Passed element `Test` is not an attribute
   * @throws \Throwable
   */
  public function testSimpleXML() {
    $simple = new \SimpleXMLElement('<Test name="value" />');
    $attribute = new XMLAttributeSimple($simple->attributes()['name']);
    self::assertEquals('name', $attribute->name());
    self::assertEquals('value', $attribute->value());
    self::assertEquals('name="value"', (string) $attribute);
    new XMLAttributeSimple($simple);
  }

  public function testAbstract() {
    $attribute = new TestAbstract(new XMLAttributeStruct('test', 3.1415), '3.14');
    self::assertEquals('test', $attribute->name());
    self::assertEquals(3.1415, $attribute->value());
    self::assertEquals('test="3.14"', (string) $attribute);
    $attribute = new TestAbstract(new XMLAttributeStruct('test', 3.1415));
    self::assertEquals('test="3.1415"', (string) $attribute);
  }
}

final class TestAbstract
  extends AbstractXMLAttribute {
}
