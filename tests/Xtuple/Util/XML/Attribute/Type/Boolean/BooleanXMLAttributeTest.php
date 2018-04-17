<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Type\Boolean;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Attribute\Optional\OptionalXMLAttributeStruct;
use Xtuple\Util\XML\Element\XMLElementString;

class BooleanXMLAttributeTest
  extends TestCase {
  public function testAttributeBoolean() {
    $attribute = new XMLAttributeBoolean('debug', true);
    self::assertEquals('debug', $attribute->name());
    self::assertTrue($attribute->value());
    self::assertEquals('debug="true"', (string) $attribute);
    $attribute = new XMLAttributeBoolean('debug', false);
    self::assertEquals('debug', $attribute->name());
    self::assertFalse($attribute->value());
    self::assertEquals('debug="false"', (string) $attribute);
  }

  /**
   * @throws \Throwable
   */
  public function testBooleanRequired() {
    $element = new XMLElementString('<Test debug="true" />');
    $attribute = new BooleanRequiredXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug'))
    );
    self::assertEquals('debug', $attribute->name());
    self::assertTrue($attribute->value());
    $element = new XMLElementString('<Test debug="TruE" />');
    $attribute = new BooleanRequiredXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug'))
    );
    self::assertTrue($attribute->value());
    $element = new XMLElementString('<Test debug="1" />');
    $attribute = new BooleanRequiredXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug'))
    );
    self::assertFalse($attribute->value());
  }

  /**
   * @throws \Throwable
   */
  public function testBooleanOptional() {
    $element = new XMLElementString('<Test debug="true" />');
    $attribute = new BooleanOptionalXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug')),
      false
    );
    self::assertEquals('debug', $attribute->name());
    self::assertTrue($attribute->value());
    $element = new XMLElementString('<Test />');
    $attribute = new BooleanOptionalXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug')),
      true
    );
    self::assertEquals('debug', $attribute->name());
    self::assertTrue($attribute->value());
    $attribute = new BooleanOptionalXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug')),
      false
    );
    self::assertFalse($attribute->value());
    $attribute = new BooleanOptionalXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug')),
      true
    );
    self::assertTrue($attribute->value());
    $attribute = new BooleanOptionalXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug', false)),
      true
    );
    self::assertFalse($attribute->value());
  }

  /**
   * @throws \Throwable
   */
  public function testCommutativity() {
    $attribute = new XMLAttributeBoolean('debug', true);
    $debug = new BooleanRequiredXMLAttribute($attribute);
    self::assertTrue($debug->value());
    $element = new XMLElementString('<Test debug="true" />');
    $debug = new BooleanRequiredXMLAttribute(
      $element->attributes()->getOptional(new OptionalXMLAttributeStruct('debug', false))
    );
    self::assertTrue($debug->value());
    $attribute = new XMLAttributeBoolean($debug->name(), $debug->value());
    self::assertEquals('debug="true"', (string) $attribute);
  }
}
