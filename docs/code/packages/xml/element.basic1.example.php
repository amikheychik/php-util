<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Attribute\Optional\OptionalXMLAttributeStruct;
use Xtuple\Util\XML\Element\XMLElementSimple;

$xml = <<<EXAMPLE
  <Configuration environment="dev" debug="true">
    <Database parameter="prefix"></Database>
    <Database parameter="name">phpunit</Database>
    <Parameter name="timezone">America/New_York</Parameter>
    Do not change
  </Configuration>
EXAMPLE;

// Default format. Convenient, if a \SimpleXMLElement was provided
/** @noinspection PhpUnhandledExceptionInspection - verified element */
$element = new XMLElementSimple(new \SimpleXMLElement($xml));
$element->name() === 'Configuration';
$element->value() === 'Do not change';
$element->isEmpty() === false;

$element->attributes()->get('debug')->value() === 'true';
// 'schema' attribute does not exist,
// but code does not fail with a null-pointer exception.
$element->attributes()->getOptional(new OptionalXMLAttributeStruct('schema'))->value() === null;

(string) $element->children('Parameter')->get(0) === '<Parameter name="timezone">America/New_York</Parameter>';
$element->children('Database')->count() === 2;
// Equivalent starting with the root tag:
$element->children('/Configuration/Database')->count() === 2;

// XPath expression may be used to filter children.
// An empty list returned if no matching elements found.
if ($dbName = $element->children('Database[@parameter="name"]')->get(0)) {
  $dbName->value() === 'phpunit';
}

$simple = new \SimpleXMLElement('<Test name="test" />');
try {
  new XMLElementSimple($simple->attributes()['name']);
}
catch (Throwable $e) {
  // Throws an exception,
  // as an attribute is passed,
  // even it's also a \SimpleXMLElement object.
}
