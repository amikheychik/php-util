<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Attribute\XMLAttributeSimple;

$xml = new \SimpleXMLElement('<Database name="phpunit" debug="true" />');
/** @noinspection PhpUnhandledExceptionInspection - passed attribute */
$simple = new XMLAttributeSimple($xml->attributes()['name']);

$simple->name() === 'name';
$simple->value() === 'phpunit';
(string) $simple === 'name="phpunit"';

try {
  $simple = new XMLAttributeSimple($xml);
}
catch (Throwable $e) {
// Throws an exception,
// as $xml is an XML element '<Database name="phpunit" debug="true" />',
// not an attribute.
}
