<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Integer;

use PHPUnit\Framework\TestCase;

class IntegerEnumTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Value `0` is not supported in Xtuple\Util\Enum\Integer\TestIntegerEnum enum
   * @throws \Throwable
   */
  public function testEnum() {
    $enum = new TestIntegerEnum(TestIntegerEnum::INT);
    self::assertEquals(1, $enum->value());
    self::assertTrue($enum->is(1));
    new TestIntegerEnum(0);
  }
}

final class TestIntegerEnum
  extends IntegerEnum {
  const INT = 1;
}
