<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type\Boolean;

use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;
use Xtuple\Util\XML\Element\Optional\AbstractOptionalXMLElement;
use Xtuple\Util\XML\Element\XMLElementStruct;

final class OptionalXMLElementBoolean
  extends AbstractOptionalXMLElement {
  public function __construct(string $name, ?bool $value = null, ?MapXMLAttribute $attributes = null,
                              ?ListXMLElement $children = null) {
    parent::__construct($value === null
      ? new XMLElementStruct($name, '', $attributes, $children)
      : new XMLElementBoolean($name, $value, $attributes, $children)
    );
  }
}
