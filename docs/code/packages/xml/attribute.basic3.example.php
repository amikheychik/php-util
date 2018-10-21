<?php
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\XML\Attribute\AbstractXMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttributeStruct;

final class FloatXMLAttribute
  extends AbstractXMLAttribute {
  public function __construct(string $name, float $value) {
    parent::__construct(
      new XMLAttributeStruct($name, $value),
      number_format($value, 2, '.', '')
    );
  }
}

$float = new FloatXMLAttribute('pi', 3.1415);
$float->value() === 3.1415;
(string) $float === 'pi="3.14"';
