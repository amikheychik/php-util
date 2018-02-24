<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Centimeter;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Meter;

class LengthTest
  extends TestCase {
  public function testStruct() {
    $length = new LengthStruct(1);
    self::assertTrue($length->unit()->is(new Meter()));
    self::assertEquals(1, $length->value());
    self::assertEquals(100, $length->in(new Centimeter())->value());
    self::assertTrue($length->in(new Centimeter())->unit()->is(new Centimeter()));
    $length = new LengthStruct(100, new Centimeter());
    self::assertTrue($length->unit()->is(new Centimeter()));
    self::assertEquals(100, $length->value());
    self::assertEquals(1, $length->in(new Meter())->value());
  }
}
