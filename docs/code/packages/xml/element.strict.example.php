<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Element\Type\Boolean\BooleanXMLElement;
use Xtuple\Util\XML\Element\Type\Boolean\OptionalXMLElementBoolean;
use Xtuple\Util\XML\Element\Type\Boolean\XMLElementBoolean;
use Xtuple\Util\XML\Element\XMLElementString;

/** @noinspection PhpUnhandledExceptionInspection - verified XML element */
$element = new XMLElementString('<Debug>true</Debug>');
$debug = new BooleanXMLElement($element->children('Debug')->get(0));

$element->children('Debug')->get(0)->value() === 'true';
$debug->value() === true;

$element = new XMLElementBoolean('Debug', true);
$element->value() === 'true';

$element = new OptionalXMLElementBoolean('Debug', null);
$element->value() === '';
