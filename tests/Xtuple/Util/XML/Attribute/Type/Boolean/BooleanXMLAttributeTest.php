<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Type\Boolean;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Attribute\XMLAttributeSimple;
use Xtuple\Util\XML\Attribute\XMLAttributeStruct;

class BooleanXMLAttributeTest
  extends TestCase {
  public function testRequired() {
    $element = (new \SimpleXMLElement('<Test debug="true" />'))->attributes()['debug'];
    $attribute = new RequiredBooleanXMLAttribute(new XMLAttributeSimple($element));
    self::assertEquals('debug', $attribute->name());
    self::assertTrue($attribute->value());
  }

  public function testOptional() {
    $element = (new \SimpleXMLElement('<Test debug="false" />'))->attributes()['debug'];
    $attribute = new OptionalBooleanXMLAttribute(new XMLAttributeSimple($element), true);
    self::assertEquals('debug', $attribute->name());
    self::assertFalse($attribute->value());
    $attribute = new OptionalBooleanXMLAttribute(new XMLAttributeStruct('debug', null), true);
    self::assertEquals('debug', $attribute->name());
    self::assertTrue($attribute->value());
  }
}
