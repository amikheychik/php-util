<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type\Boolean;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Element\XMLElementString;

class BooleanXMLElementTest
  extends TestCase {
  public function testBoolean() {
    $boolean = new BooleanXMLElement(new XMLElementString('<Test>true</Test>'));
    self::assertTrue($boolean->value());
    $boolean = new BooleanXMLElement(new XMLElementString('<Test>False</Test>'));
    self::assertFalse($boolean->value());
    $boolean = new BooleanXMLElement(new XMLElementString('<Test>1</Test>'));
    self::assertFalse($boolean->value());
    $boolean = new BooleanXMLElement(new XMLElementString('<Test debug="true"><Child>Value</Child>1</Test>'));
    self::assertEquals('Test', $boolean->name());
    self::assertEquals('true', $boolean->attributes()->get('debug')->value());
    self::assertEquals('Value', $boolean->children('Child')->get(0)->value());
    self::assertFalse($boolean->value());
    self::assertFalse($boolean->isEmpty());
    self::assertEquals(
      '<Test debug="true"><Child>Value</Child>1</Test>',
      (string) $boolean
    );
  }

  public function testXMLElement() {
    $element = new XMLElementBoolean('Test', true);
    self::assertEquals('true', $element->value());
    $element = new XMLElementBoolean('Test', false);
    self::assertEquals('false', $element->value());
    $element = new OptionalXMLElementBoolean('Test', true);
    self::assertEquals('true', $element->value());
    $element = new OptionalXMLElementBoolean('Test', false);
    self::assertEquals('false', $element->value());
    $element = new OptionalXMLElementBoolean('Test');
    self::assertEquals('', $element->value());
  }
}
