<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Element\Collection\Sequence\ArrayListXMLElement;
use Xtuple\Util\XML\Element\XMLElementSequence;
use Xtuple\Util\XML\Element\XMLElementString;

/** @noinspection PhpUnhandledExceptionInspection - verified element types */
/** @noinspection PhpUnhandledExceptionInspection - verified XML elements */
$element = new XMLElementSequence(new ArrayListXMLElement([
  new XMLElementString('<Name>phpunit</Name>'),
  new XMLElementString('<Debug>true</Debug>'),
  new XMLElementString('<Encoding>UTF-8</Encoding>'),
]));

$element->name() === '';
$element->value() === '';
$element->attributes()->isEmpty() === true;
$element->isEmpty() === false;
$element->children('Name')->get(0)->value() === 'phpunit';
(string) $element === '<Name>phpunit</Name><Debug>true</Debug><Encoding>UTF-8</Encoding>';
