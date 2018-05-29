<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\Sequence;

use PHPUnit\Framework\TestCase;

class SequenceTypeStructTest
  extends TestCase {
  public function testConstructor() {
    $type = new class (new SequenceTypeStruct('Example', 'http://www.example.com/ExampleSchema'))
      extends AbstractSequenceType {
    };
    self::assertEquals(SOAP_ENC_ARRAY, $type->encoding());
    self::assertEquals('Example', $type->name());
    self::assertEquals('http://www.example.com/ExampleSchema', $type->namespace());
  }
}
