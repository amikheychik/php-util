<?php declare(strict_types=1);

namespace Xtuple\Util\Enum\Bitmask;

use PHPUnit\Framework\TestCase;

class BitmaskEnumTest
  extends TestCase {
  /**
   * @expectedException \LogicException
   * @expectedExceptionMessage Bitmask Xtuple\Util\Enum\Bitmask\IncorrectBitmask values do not form full 15 (0b1111)
   *                           mask
   * @throws \Throwable
   */
  public function testValues() {
    new CorrectBitmask(CorrectBitmask::ZERO);
    $bitmask = new CorrectBitmask(CorrectBitmask::ZERO | CorrectBitmask::FOUR | CorrectBitmask::EIGHT);
    self::assertEquals(0b1100, $bitmask->value());
    $bitmask = new CorrectBitmask(CorrectBitmask::TWO | CorrectBitmask::FOUR | CorrectBitmask::EIGHT);
    self::assertTrue($bitmask->is(0b1110));
    new IncorrectBitmask(IncorrectBitmask::ZERO);
  }

  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage Value `16` is not supported in bitmask enum Xtuple\Util\Enum\Bitmask\SplitBitmask
   * @throws \Throwable
   */
  public function testConstructor() {
    new SplitBitmask(SplitBitmask::ONE | SplitBitmask::THREE | SplitBitmask::TWELVE | SplitBitmask::FIFTEEN);
    new SplitBitmask(0b10000);
  }
}

final class CorrectBitmask
  extends BitmaskEnum {
  public const ZERO = 0b0;
  public const ONE = 0b0001;
  public const TWO = 0b0010;
  public const FOUR = 0b0100;
  public const EIGHT = 0b1000;
}

final class IncorrectBitmask
  extends BitmaskEnum {
  public const ZERO = 0b0;
  public const ONE = 0b0001;
  public const FOUR = 0b0100;
  public const EIGHT = 0b1000;
}

final class SplitBitmask
  extends BitmaskEnum {
  public const ONE = 0b0001;
  public const THREE = 0b0011;
  public const TWELVE = 0b1100;
  public const FIFTEEN = 0b1000;
}
