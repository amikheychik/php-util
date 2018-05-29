<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD;

use PHPUnit\Framework\TestCase;

class XSDTypeStructTest
  extends TestCase {
  public function testConstructor() {
    $type = new class (new XSDTypeStruct(XSD_STRING, 'string'))
      extends AbstractXSDType {
    };
    self::assertEquals(101, $type->encoding());
    self::assertEquals('string', $type->name());
    self::assertEquals('http://www.w3.org/2001/XMLSchema', $type->namespace());
  }
}
