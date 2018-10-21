<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Attribute\Collection\Map\ArrayMapXMLAttribute;
use Xtuple\Util\XML\Attribute\Optional\OptionalXMLAttributeStruct;
use Xtuple\Util\XML\Attribute\Type\Boolean\XMLAttributeBoolean;
use Xtuple\Util\XML\Attribute\XMLAttributeStruct;

/** @noinspection PhpUnhandledExceptionInspection - verified types */
$attributes = new ArrayMapXMLAttribute([
  new XMLAttributeStruct('database', 'phpunit'),
  new XMLAttributeBoolean('debug', true),
]);

(string) $attributes === 'database="phpunit" debug="true"';
$attributes->get('debug')->value() === true;
$attributes->getOptional(
  new OptionalXMLAttributeStruct('debug')
)->value() === null;
$attributes->count() === 2;
