<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Attribute\Collection\Map\ArrayMapXMLAttribute;
use Xtuple\Util\XML\Attribute\Optional\OptionalXMLAttributeStruct;
use Xtuple\Util\XML\Attribute\Type\Boolean\BooleanOptionalXMLAttribute;

/** @noinspection PhpUnhandledExceptionInspection - verified empty */
$attributes = new ArrayMapXMLAttribute();
$attributes->get('test') === null;
$attributes->getOptional(
  new OptionalXMLAttributeStruct('test')
)->value() === null;
$attributes->getOptional(
  new OptionalXMLAttributeStruct('test', true)
)->value() === true;

// getOptional() default value is returned only if attribute doesn't exist.
// So for strict types, wrapping is still required.
$attribute = new BooleanOptionalXMLAttribute(
  $attributes->getOptional(new OptionalXMLAttributeStruct('test', false)),
  true
);
// OptionalXMLAttributeStruct is used as the default value,
// so `true` in BooleanOptionalXMLAttribute is not default.
$attribute->value() === false;

// Note that optional default value is `null`
$attribute = new BooleanOptionalXMLAttribute(
  $attributes->getOptional(new OptionalXMLAttributeStruct('test')),
  true
);
// Now BooleanOptionalXMLAttribute default is used.
$attribute->value() === true;
