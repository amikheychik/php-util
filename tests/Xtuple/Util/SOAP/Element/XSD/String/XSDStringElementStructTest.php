<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD\String;

use PHPUnit\Framework\TestCase;

class XSDStringElementStructTest
  extends TestCase {
  public function testConstructor() {
    $element = new XSDStringElementStruct('TestExample', 'http://www.example.com/ExampleSchema', 'Test');
    self::assertEquals('string', $element->type()->name());
    self::assertEquals('TestExample', $element->name());
    self::assertEquals('http://www.example.com/ExampleSchema', $element->namespace());
    self::assertEquals('Test', $element->soap()->value());
    $element = new XSDStringElementStruct('TestExample', null, 'Test');
    self::assertNull($element->namespace());
  }
}
