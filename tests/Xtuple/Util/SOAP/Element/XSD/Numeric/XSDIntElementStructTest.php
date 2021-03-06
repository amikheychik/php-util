<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD\Numeric;

use PHPUnit\Framework\TestCase;

class XSDIntElementStructTest
  extends TestCase {
  public function testConstructor() {
    $element = new XSDIntElementStruct('Example', 'http://www.example.com/ExampleSchema', 42);
    self::assertEquals('int', $element->type()->name());
    self::assertEquals('Example', $element->name());
    self::assertEquals('http://www.example.com/ExampleSchema', $element->namespace());
    self::assertEquals(42, $element->soap()->value());
    $element = new XSDIntElementStruct('Example', null, 42);
    self::assertNull($element->namespace());
  }
}
