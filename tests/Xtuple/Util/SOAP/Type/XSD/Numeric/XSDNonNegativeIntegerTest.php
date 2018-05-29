<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD\Numeric;

use PHPUnit\Framework\TestCase;

class XSDNonNegativeIntegerTest
  extends TestCase {
  public function testConstructor() {
    $type = new XSDNonNegativeInteger();
    self::assertEquals(XSD_NONNEGATIVEINTEGER, $type->encoding());
    self::assertEquals('nonNegativeInteger', $type->name());
    self::assertEquals('http://www.w3.org/2001/XMLSchema', $type->namespace());
  }
}
