<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD\Numeric;

use PHPUnit\Framework\TestCase;

class XSDDecimalTest
  extends TestCase {
  public function testConstructor() {
    $type = new XSDDecimal();
    self::assertEquals(XSD_DECIMAL, $type->encoding());
    self::assertEquals('decimal', $type->name());
    self::assertEquals('http://www.w3.org/2001/XMLSchema', $type->namespace());
  }
}
