<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use Xtuple\Util\XML\Attribute\Collection\Map\ArrayMapXMLAttribute;
use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ArrayListXMLElement;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;

final class XMLElementStruct
  extends AbstractXMLElement {
  /**
   * @param string               $name
   * @param null|string          $value
   * @param null|MapXMLAttribute $attributes
   * @param null|ListXMLElement  $children
   */
  public function __construct(string $name, ?string $value = null, ?MapXMLAttribute $attributes = null,
                              ?ListXMLElement $children = null) {
    $attributes = $attributes ?: new ArrayMapXMLAttribute();
    $children = $children ?: new ArrayListXMLElement();
    parent::__construct(new XMLElementString(strtr('<{name}{attributes}>{children}{value}</{name}>', [
      '{name}' => $name,
      '{attributes}' => ($attributes = (string) $attributes) ? " {$attributes}" : '',
      '{children}' => (string) $children,
      '{value}' => $value,
    ])));
  }
}
