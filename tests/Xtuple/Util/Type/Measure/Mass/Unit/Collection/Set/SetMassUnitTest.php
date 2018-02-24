<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure\Mass\Unit\Collection\Set;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Kilogram;

class SetMassUnitTest
  extends TestCase {
  /**
   * @expectedException Exception
   * @expectedExceptionMessage Mass unit unknown is not supported
   */
  public function testMassUnits() {
    $units = new MassUnits();
    self::assertTrue($units->get('kg')->is(new Kilogram()));
    self::assertTrue($units->find('Kilos')->is(new Kilogram()));
    $units->find('unknown');
  }

  public function testArraySetMassUnit() {
    $units = new ArraySetMassUnit([
      'K' => new Kilogram(),
    ], false);
    self::assertNull($units->get('K'));
    self::assertTrue($units->get('kg')->is(new Kilogram()));
    $units = new ArraySetMassUnit([
      'K' => new Kilogram(),
    ], true);
    self::assertTrue($units->get('K')->is(new Kilogram()));
    self::assertNull($units->get('kg'));
    /** @noinspection PhpUnhandledExceptionInspection */
    self::assertTrue($units->find('k')->is(new Kilogram()));
  }
}
