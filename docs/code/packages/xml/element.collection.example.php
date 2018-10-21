<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Element\Collection\Sequence\ArrayListXMLElement;
use Xtuple\Util\XML\Element\XMLElementString;

/** @noinspection PhpUnhandledExceptionInspection - verified XML element, verified elements types */
$list = new ArrayListXMLElement([
  new XMLElementString('<Debug>true</Debug>'),
  new XMLElementString('<Test>false</Test>'),
]);
(string) $list === '<Debug>true</Debug><Test>false</Test>';
