<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Optional;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Attribute\Collection\Map\ArrayMapXMLAttribute;
use Xtuple\Util\XML\Attribute\Type\Boolean\XMLAttributeBoolean;
use Xtuple\Util\XML\Element\Collection\Sequence\ArrayListXMLElement;
use Xtuple\Util\XML\Element\Type\Boolean\XMLElementBoolean;
use Xtuple\Util\XML\Element\XMLElementStruct;

class OptionalXMLElementTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testOptional() {
    $element = new OptionalXMLElement(new XMLElementStruct('Debug', 'true'));
    self::assertEquals('<Debug>true</Debug>', (string) $element);
    self::assertEquals('Debug', $element->name());
    $element = new OptionalXMLElement(new XMLElementStruct('Debug'));
    self::assertEquals('', (string) $element);
    self::assertEquals('Debug', $element->name());
    $element = new OptionalXMLElement(new XMLElementStruct('Debug', null, new ArrayMapXMLAttribute([
      new XMLAttributeBoolean('test', true),
    ])));
    self::assertEquals('<Debug test="true"/>', (string) $element);
    self::assertFalse($element->isEmpty());
    self::assertEquals('true', $element->attributes()->get('test')->value());
    $element = new OptionalXMLElement(new XMLElementStruct('Debug', null, null, new ArrayListXMLElement([
      new XMLElementBoolean('Test', true),
    ])));
    self::assertEquals('<Debug><Test>true</Test></Debug>', (string) $element);
    self::assertFalse($element->isEmpty());
    self::assertEquals('true', $element->children('Test')->get(0)->value());
    $element = new OptionalXMLElement(new XMLElementStruct('Debug', 'false', new ArrayMapXMLAttribute([
      new XMLAttributeBoolean('test', true),
    ]), new ArrayListXMLElement([
      new XMLElementBoolean('Test', true),
    ])));
    self::assertEquals('<Debug test="true"><Test>true</Test>false</Debug>', (string) $element);
  }

  public function testStruct() {
    $element = new OptionalXMLElementStruct('Debug', 'true');
    self::assertEquals('<Debug>true</Debug>', (string) $element);
    $element = new OptionalXMLElementStruct('Debug');
    self::assertEquals('', (string) $element);
  }
}
