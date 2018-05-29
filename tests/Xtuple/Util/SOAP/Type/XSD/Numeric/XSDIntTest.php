<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD\Numeric;

use PHPUnit\Framework\TestCase;

class XSDIntTest
  extends TestCase {
  public function testConstructor() {
    $type = new XSDInt();
    self::assertEquals(XSD_INT, $type->encoding());
    self::assertEquals('int', $type->name());
    self::assertEquals('http://www.w3.org/2001/XMLSchema', $type->namespace());
  }
}
