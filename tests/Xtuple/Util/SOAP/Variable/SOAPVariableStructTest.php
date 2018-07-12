<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Variable;

use PHPUnit\Framework\TestCase;

class SOAPVariableStructTest
  extends TestCase {
  public function testConstructor() {
    $variable = new SOAPVariableStruct(
      new \SoapVar('Example', XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema')
    );
    self::assertEquals('Example', $variable->value());
    /** @noinspection PhpUndefinedFieldInspection */
    self::assertEquals('Example', $variable->variable()->enc_value);
  }
}
