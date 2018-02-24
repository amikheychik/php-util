<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Centimeter;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Inch;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Meter;

class LengthUnitTest
  extends TestCase {
  public function testMeter() {
    $meter = new Meter();
    self::assertEquals('m', $meter->symbol());
    self::assertEquals('Meter', $meter->name());
    self::assertEquals(['m', 'meter', 'meters', 'metre', 'metres'], $meter->synonyms());
    self::assertEquals(1, $meter->toSI(1));
    self::assertEquals(1, $meter->fromSI(1));
    self::assertTrue($meter->is(new Meter()));
    self::assertFalse($meter->is(new Centimeter()));
  }

  public function testCentimeter() {
    $centimeter = new Centimeter();
    self::assertEquals('cm', $centimeter->symbol());
    self::assertEquals('Centimeter', $centimeter->name());
    self::assertEquals(['centimeter', 'centimeters', 'centimetre', 'centimetres', 'cm'], $centimeter->synonyms());
    self::assertEquals(1, $centimeter->toSI(100));
    self::assertEquals(1, $centimeter->fromSI(0.01));
    self::assertTrue($centimeter->is(new Centimeter()));
    self::assertFalse($centimeter->is(new Meter()));
  }

  public function testInch() {
    $inch = new Inch();
    self::assertEquals('in', $inch->symbol());
    self::assertEquals('Inch', $inch->name());
    self::assertEquals(['in', 'inch', 'inches'], $inch->synonyms());
    self::assertEquals(1, $inch->toSI(39.37007874));
    self::assertEquals(1, $inch->fromSI(0.0254));
    self::assertTrue($inch->is(new Inch()));
    self::assertFalse($inch->is(new Meter()));
  }
}
