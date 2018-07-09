<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Char;

use PHPUnit\Framework\TestCase;

class OptionalStringEnumTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Value `0` is not supported in Xtuple\Util\Enum\Char\TestOptionalStringEnum enum
   * @throws \Throwable
   */
  public function testEnum() {
    $enum = new TestOptionalStringEnum(TestOptionalStringEnum::STRING);
    self::assertEquals('value', $enum->value());
    self::assertTrue($enum->is('value'));
    $enum = new TestOptionalStringEnum(null);
    self::assertNull($enum->value());
    self::assertTrue($enum->is(null));
    new TestOptionalStringEnum('0');
  }
}

final class TestOptionalStringEnum
  extends OptionalStringEnum {
  public const STRING = 'value';
  public const INT = 0;
}
