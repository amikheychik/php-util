<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Attribute\Type\Boolean\BooleanOptionalXMLAttribute;
use Xtuple\Util\XML\Attribute\Type\Boolean\BooleanRequiredXMLAttribute;
use Xtuple\Util\XML\Attribute\Type\Boolean\XMLAttributeBoolean;
use Xtuple\Util\XML\Attribute\XMLAttributeStruct;
use Xtuple\Util\XML\Element\XMLElementString;

// XMLAttributeStruct does not provide custom handling for the value types.
// Use custom type classes instead.
$struct = new XMLAttributeStruct('debug', true);

// The value is preserved and output keeps default string cast behavior.
$struct->value() === true;
(string) $struct === 'debug="1"';

// If BooleanRequiredXMLAttribute is used later on XML with this attribute,
// value check would fail:
/** @noinspection PhpUnhandledExceptionInspection - verified XML input */
$element = new XMLElementString('<Database name="phpunit" debug="1" />');
$debug = new BooleanRequiredXMLAttribute($element->attributes()->get('debug'));
// BooleanRequiredXMLAttribute checks if value matches "true",
// not "1" (check is case-insensitive)
$debug->value() !== true;

// To avoid this, use a strictly typed attribute
$attribute = new XMLAttributeBoolean('debug', true);
(string) $attribute === 'debug="true"';
$debug = new BooleanRequiredXMLAttribute($attribute);
$debug->value() === true;

// BooleanOptionalXMLAttribute may be used when an attribute may be missing.
// It requires to provide a default value.
// Note: XMLAttribute object is still required and must not be null.
$test = new BooleanOptionalXMLAttribute(
  $element->attributes()->get('test'),
  true
);
// As the 'test' attribute is missing, the default value is returned.
$test->value() === true;
