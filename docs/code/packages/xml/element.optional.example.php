<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Element\Optional\OptionalXMLElement;
use Xtuple\Util\XML\Element\Optional\OptionalXMLElementStruct;
use Xtuple\Util\XML\Element\XMLElementStruct;

$element = new OptionalXMLElement(new XMLElementStruct('Debug', 'true'));
(string) $element === '<Debug>true</Debug>';
$element = new OptionalXMLElement(new XMLElementStruct('Debug'));
(string) $element === '';

$element = new OptionalXMLElementStruct('Debug', 'true');
(string) $element === '<Debug>true</Debug>';
$element = new OptionalXMLElementStruct('Debug');
(string) $element === '';
