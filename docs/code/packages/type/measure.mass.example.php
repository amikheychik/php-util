<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\Measure\Mass\MassStruct;
use Xtuple\Util\Type\Measure\Mass\Unit\Collection\Set\ArraySetMassUnit;
use Xtuple\Util\Type\Measure\Mass\Unit\Collection\Set\MassUnits;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Gram;
use Xtuple\Util\Type\Measure\Mass\Unit\Unit\Kilogram;

// When $unit parameter may be skipped, the base unit (SI unit) is used.
$length = new MassStruct(3.14);
$length->value() === 3.14;
$length->unit()->is(new Kilogram()) === true;
$length->in(new Gram())->value() === 3140;

$units = new MassUnits();
$units->get('kg')->is(new Kilogram()) === true;
$units->get('m') === null;
// find() is case-insensitive.
/** @noinspection PhpUnhandledExceptionInspection - unit exists */
$units->find('KILOS')->is(new Kilogram()) === true;

// Third-party integrations may have custom symbols.
/** @noinspection PhpUnhandledExceptionInspection - verified types */
$units = new ArraySetMassUnit([
  'KGS' => new Kilogram(),
], true);
$units->get('kg')->is(new Kilogram()) === true;
$units->get('gram') === null;
/** @noinspection PhpUnhandledExceptionInspection - custom alias exists */
$units->find('kgs')->is(new Kilogram()) === true;
try {
  $units->find('gram');
}
catch (Throwable $e) {
  // Throws an exception, as "gram" unit is not found
}
