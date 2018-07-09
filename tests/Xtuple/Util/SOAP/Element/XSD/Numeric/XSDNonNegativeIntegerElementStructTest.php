<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD\Numeric;

use PHPUnit\Framework\TestCase;

class XSDNonNegativeIntegerElementStructTest
  extends TestCase {
  public function testConstructor() {
    $element = new XSDNonNegativeIntegerElementStruct('TestExample', 'http://www.example.com/ExampleSchema', -1);
    self::assertEquals('nonNegativeInteger', $element->type()->name());
    self::assertEquals('TestExample', $element->name());
    self::assertEquals('http://www.example.com/ExampleSchema', $element->namespace());
    self::assertEquals(-1, $element->soap()->value());
    $element = new XSDNonNegativeIntegerElementStruct('TestExample', null, -1);
    self::assertNull($element->namespace());
  }
}
