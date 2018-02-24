<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Gram;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Kilogram;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Ounce;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Pound;

class MassUnitTest
  extends TestCase {
  public function testKilogram() {
    $kilo = new Kilogram();
    self::assertEquals('kg', $kilo->symbol());
    self::assertEquals('Kilogram', $kilo->name());
    self::assertEquals(['kg', 'kgs', 'kilo', 'kilogram', 'kilograms', 'kilos'], $kilo->synonyms());
    self::assertEquals(1, $kilo->toSI(1));
    self::assertEquals(1, $kilo->fromSI(1));
    self::assertTrue($kilo->is(new Kilogram()));
    self::assertFalse($kilo->is(new Gram()));
  }

  public function testPound() {
    $pound = new Pound();
    self::assertEquals('lb', $pound->symbol());
    self::assertEquals('Pound', $pound->name());
    self::assertEquals(['lb', 'lbs', 'pound', 'pounds'], $pound->synonyms());
    self::assertEquals(1, $pound->toSI(2.20462442));
    self::assertEquals(1, $pound->fromSI(0.453592));
    self::assertTrue($pound->is(new Pound()));
    self::assertFalse($pound->is(new Kilogram()));
  }

  public function testGram() {
    $gram = new Gram();
    self::assertEquals('g', $gram->symbol());
    self::assertEquals('Gram', $gram->name());
    self::assertEquals(['g', 'gm', 'gram', 'grams', 'gs'], $gram->synonyms());
    self::assertEquals(1, $gram->toSI(1000));
    self::assertEquals(1, $gram->fromSI(0.001));
    self::assertTrue($gram->is(new Gram()));
    self::assertFalse($gram->is(new Kilogram()));
  }

  public function testOunce() {
    $ounce = new Ounce();
    self::assertEquals('oz', $ounce->symbol());
    self::assertEquals('Ounce', $ounce->name());
    self::assertEquals(['ounce', 'ounces', 'oz'], $ounce->synonyms());
    self::assertEquals(1, $ounce->toSI(35.27396195));
    self::assertEquals(1, $ounce->fromSI(0.028349523125));
    self::assertTrue($ounce->is(new Ounce()));
    self::assertFalse($ounce->is(new Kilogram()));
  }
}
