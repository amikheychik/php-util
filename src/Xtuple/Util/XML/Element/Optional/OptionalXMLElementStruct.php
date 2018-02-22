<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Optional;

use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;
use Xtuple\Util\XML\Element\XMLElementStruct;

final class OptionalXMLElementStruct
  extends AbstractOptionalXMLElement {
  /**
   * @param string               $name
   * @param null|string          $value
   * @param null|MapXMLAttribute $attributes
   * @param null|ListXMLElement  $children
   */
  public function __construct(string $name, ?string $value = null, ?MapXMLAttribute $attributes = null,
                              ?ListXMLElement $children = null) {
    parent::__construct(new XMLElementStruct($name, $value, $attributes, $children));
  }
}
