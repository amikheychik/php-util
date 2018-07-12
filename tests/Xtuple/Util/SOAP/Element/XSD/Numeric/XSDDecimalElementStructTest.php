<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD\Numeric;

use PHPUnit\Framework\TestCase;

class XSDDecimalElementStructTest
  extends TestCase {
  public function testConstructor() {
    $element = new XSDDecimalElementStruct('Example', 'http://www.example.com/ExampleSchema', 3.1415);
    self::assertEquals('decimal', $element->type()->name());
    self::assertEquals('Example', $element->name());
    self::assertEquals('http://www.example.com/ExampleSchema', $element->namespace());
    self::assertEquals(3.1415, $element->soap()->value());
    $element = new XSDDecimalElementStruct('Example', null, 3.1415);
    self::assertNull($element->namespace());
  }
}
