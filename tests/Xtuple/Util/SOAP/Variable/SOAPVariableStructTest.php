<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Variable;

use PHPUnit\Framework\TestCase;

class SOAPVariableStructTest
  extends TestCase {
  public function testConstructor() {
    $variable = new SOAPVariableStruct(
      new \SoapVar('TestExample', XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema')
    );
    self::assertEquals('TestExample', $variable->value());
    /** @noinspection PhpUndefinedFieldInspection */
    self::assertEquals('TestExample', $variable->variable()->enc_value);
  }
}
