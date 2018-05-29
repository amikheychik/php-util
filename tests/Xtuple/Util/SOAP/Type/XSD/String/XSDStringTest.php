<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD\String;

use PHPUnit\Framework\TestCase;

class XSDStringTest
  extends TestCase {
  public function testConstructor() {
    $type = new XSDString();
    self::assertEquals(XSD_STRING, $type->encoding());
    self::assertEquals('string', $type->name());
    self::assertEquals('http://www.w3.org/2001/XMLSchema', $type->namespace());
  }
}
