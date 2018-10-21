<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Attribute\XMLAttributeStruct;

$struct = new XMLAttributeStruct('name', 'phpunit');

$struct->name() === 'name';
$struct->value() === 'phpunit';
(string) $struct === 'name="phpunit"';
