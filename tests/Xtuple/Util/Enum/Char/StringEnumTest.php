<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Char;

use PHPUnit\Framework\TestCase;

class StringEnumTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Value `0` is not supported in Xtuple\Util\Enum\Char\TestStringEnum enum
   * @throws \Throwable
   */
  public function testEnum() {
    $enum = new TestStringEnum(TestStringEnum::STRING);
    self::assertEquals('value', (string) $enum);
    self::assertEquals('value', $enum->value());
    self::assertTrue($enum->is('value'));
    new TestStringEnum('0');
  }
}

final class TestStringEnum
  extends StringEnum {
  const STRING = 'value';
  const INT = 0;
}
