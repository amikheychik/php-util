<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD\Misc;

use PHPUnit\Framework\TestCase;

class XSDBooleanTest
  extends TestCase {
  public function testConstructor() {
    $type = new XSDBoolean();
    self::assertEquals(XSD_BOOLEAN, $type->encoding());
    self::assertEquals('boolean', $type->name());
    self::assertEquals('http://www.w3.org/2001/XMLSchema', $type->namespace());
  }
}
