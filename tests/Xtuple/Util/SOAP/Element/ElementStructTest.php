<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\SOAP\Type\XSD\String\XSDString;

class ElementStructTest
  extends TestCase {
  public function testConstructor() {
    $element = new ElementStruct(new XSDString(), 'Name', 'http://www.example.com/ExampleSchema', 'Example');
    self::assertEquals('string', $element->type()->name());
    self::assertEquals('Name', $element->name());
    self::assertEquals('http://www.example.com/ExampleSchema', $element->namespace());
    self::assertEquals('Example', $element->soap()->value());
    $element = new ElementStruct(new XSDString(), 'Name', null, 'Example');
    self::assertEquals('string', $element->type()->name());
    self::assertEquals('Name', $element->name());
    self::assertNull($element->namespace());
    self::assertEquals('Example', $element->soap()->value());
  }
}
