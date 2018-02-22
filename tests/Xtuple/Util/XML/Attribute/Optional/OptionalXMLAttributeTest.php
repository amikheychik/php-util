<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Optional;

use PHPUnit\Framework\TestCase;

class OptionalXMLAttributeTest
  extends TestCase {
  public function testStruct() {
    $attribute = new OptionalXMLAttributeStruct('debug');
    self::assertEquals('debug', $attribute->name());
    self::assertNull($attribute->value());
    self::assertEquals('', (string) $attribute);
    $attribute = new OptionalXMLAttributeStruct('debug', 'true');
    self::assertEquals('true', $attribute->value());
    self::assertEquals('debug="true"', (string) $attribute);
  }
}
