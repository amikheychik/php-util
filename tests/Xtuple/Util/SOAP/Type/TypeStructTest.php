<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type;

use PHPUnit\Framework\TestCase;

class TypeStructTest
  extends TestCase {
  public function testConstructor() {
    $type = new class (new TypeStruct(XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema'))
      extends AbstractType {
    };
    self::assertEquals(101, $type->encoding());
    self::assertEquals('string', $type->name());
    self::assertEquals('http://www.w3.org/2001/XMLSchema', $type->namespace());
  }
}

