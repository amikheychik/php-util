<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Gram;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Kilogram;

class MassTest
  extends TestCase {
  public function testStruct() {
    $weight = new MassStruct(1);
    self::assertTrue($weight->unit()->is(new Kilogram()));
    self::assertEquals(1, $weight->value());
    self::assertEquals(1000, $weight->in(new Gram())->value());
    self::assertTrue($weight->in(new Gram())->unit()->is(new Gram()));
    $weight = new MassStruct(1, new Gram());
    self::assertTrue($weight->unit()->is(new Gram()));
    self::assertEquals(1, $weight->value());
    self::assertEquals(0.001, $weight->in(new Kilogram())->value());
  }
}
