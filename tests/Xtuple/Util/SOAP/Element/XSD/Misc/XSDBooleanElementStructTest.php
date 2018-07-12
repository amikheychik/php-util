<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD\Misc;

use PHPUnit\Framework\TestCase;

class XSDBooleanElementStructTest
  extends TestCase {
  public function testConstructor() {
    $element = new XSDBooleanElementStruct('Example', 'http://www.example.com/Schema', true);
    self::assertEquals('boolean', $element->type()->name());
    self::assertEquals('Example', $element->name());
    self::assertEquals('http://www.example.com/Schema', $element->namespace());
    self::assertTrue($element->soap()->value());
    $element = new XSDBooleanElementStruct('Example', null, false);
    self::assertNull($element->namespace());
    self::assertFalse($element->soap()->value());
  }
}
