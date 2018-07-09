<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\SOAP\Type\XSD\String\XSDString;

class XSDElementStructTest
  extends TestCase {
  public function testConstructor() {
    $element = new class (new XSDElementStruct(new XSDString(), 'TestExample', 'http://www.example.com/ExampleSchema', 'Test'))
      extends AbstractXSDElement {
    };
    self::assertEquals('string', $element->type()->name());
    self::assertEquals('TestExample', $element->name());
    self::assertEquals('http://www.example.com/ExampleSchema', $element->namespace());
    self::assertEquals('Test', $element->soap()->value());
    $element = new class (new XSDElementStruct(new XSDString(), 'TestExample', null, 'Test'))
      extends AbstractXSDElement {
    };
    self::assertNull($element->namespace());
  }
}
