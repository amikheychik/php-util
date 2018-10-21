<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Attribute\Collection\Map\ArrayMapXMLAttribute;
use Xtuple\Util\XML\Attribute\Type\Boolean\XMLAttributeBoolean;
use Xtuple\Util\XML\Attribute\XMLAttributeStruct;
use Xtuple\Util\XML\Element\Collection\Sequence\ArrayListXMLElement;
use Xtuple\Util\XML\Element\XMLElementString;
use Xtuple\Util\XML\Element\XMLElementStruct;

/** @noinspection PhpUnhandledExceptionInspection - verified element types */
/** @noinspection PhpUnhandledExceptionInspection - verified XML element */
$element = new XMLElementStruct('Setup', 'Value', new ArrayMapXMLAttribute([
  new XMLAttributeStruct('database', 'phpunit'),
  new XMLAttributeBoolean('debug', true),
]), new ArrayListXMLElement([
  new XMLElementString('<Timezone>America/New_York</Timezone>'),
]));

(string) $element === '<Setup database="phpunit" debug="true"><Timezone>America/New_York</Timezone>Value</Setup>';
