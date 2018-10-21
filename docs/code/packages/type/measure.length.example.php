<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\Measure\Length\LengthStruct;
use Xtuple\Util\Type\Measure\Length\Unit\Collection\Set\ArraySetLengthUnit;
use Xtuple\Util\Type\Measure\Length\Unit\Collection\Set\LengthUnits;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Centimeter;
use Xtuple\Util\Type\Measure\Length\Unit\Unit\Meter;

// When $unit parameter may be skipped, the base unit (SI unit) is used.
$length = new LengthStruct(3.14);
$length->value() === 3.14;
$length->unit()->is(new Meter()) === true;
$length->in(new Centimeter())->value() === 314;

$units = new LengthUnits();
$units->get('m')->is(new Meter()) === true;
$units->get('kg') === null;
// find() is case-insensitive.
/** @noinspection PhpUnhandledExceptionInspection - unit exists */
$units->find('METRES')->is(new Meter()) === true;

// Third-party integrations may have custom symbols.
/** @noinspection PhpUnhandledExceptionInspection - verified types */
$units = new ArraySetLengthUnit([
  'MTR' => new Meter(),
], true);
$units->get('mtr')->is(new Meter()) === true;
$units->get('inch') === null;
/** @noinspection PhpUnhandledExceptionInspection - unit alias exists */
$units->find('mtr')->is(new Meter()) === true;
try {
  $units->find('foot');
}
catch (Throwable $e) {
  // Throws an exception, as "foot" unit is not found
}
