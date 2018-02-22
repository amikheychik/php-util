<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type\Boolean;

use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\AbstractXMLElement;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;
use Xtuple\Util\XML\Element\XMLElementStruct;

final class XMLElementBoolean
  extends AbstractXMLElement {
  public function __construct(string $name, bool $value, ?MapXMLAttribute $attributes = null,
                              ?ListXMLElement $children = null) {
    parent::__construct(new XMLElementStruct($name, $value ? 'true' : 'false', $attributes, $children));
  }
}
