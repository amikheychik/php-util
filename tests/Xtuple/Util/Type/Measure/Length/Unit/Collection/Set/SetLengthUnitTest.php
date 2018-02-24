<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Length\Unit\Collection\Set;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Meter;

class SetLengthUnitTest
  extends TestCase {
  /**
   * @expectedException Exception
   * @expectedExceptionMessage Length unit unknown is not supported
   */
  public function testLengthUnits() {
    $units = new LengthUnits();
    self::assertTrue($units->get('m')->is(new Meter()));
    self::assertTrue($units->find('Metres')->is(new Meter()));
    $units->find('unknown');
  }

  public function testArraySetLengthUnit() {
    $units = new ArraySetLengthUnit([
      'M' => new Meter(),
    ], false);
    self::assertNull($units->get('M'));
    self::assertTrue($units->get('m')->is(new Meter()));
    $units = new ArraySetLengthUnit([
      'MTR' => new Meter(),
    ], true);
    self::assertTrue($units->get('MTR')->is(new Meter()));
    self::assertNull($units->get('m'));
    /** @noinspection PhpUnhandledExceptionInspection */
    self::assertTrue($units->find('mtr')->is(new Meter()));
  }
}
