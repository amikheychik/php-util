<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use Xtuple\Util\XML\Attribute\Collection\Map\ArrayMapXMLAttribute;
use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttributeSimple;
use Xtuple\Util\XML\Attribute\XMLAttributeStruct;
use Xtuple\Util\XML\Element\Collection\Sequence\ArrayListXMLElement;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;

final class XMLElementSimple
  implements XMLElement {
  /** @var \SimpleXMLElement */
  private $element;

  public function __construct(\SimpleXMLElement $element) {
    if (is_null($element->attributes())) {
      throw new \InvalidArgumentException('Passed element is an attribute.');
    }
    /** @workaround Remove default namespace as \SimpleXMLElement->xpath() doesn't support default namespaces */
    foreach ($element->getNamespaces() as $prefix => $namespace) {
      if (empty($prefix)) {
        $pattern = "xmlns={'}{$namespace}{'}";
        $element = new \SimpleXMLElement(str_replace([
          str_replace("{'}", '"', $pattern),
          str_replace("{'}", "'", $pattern),
        ], '', $element->asXML()));
      }
    }
    $this->element = $element;
  }

  public function attributes(?string $ns = null, bool $isPrefix = false): MapXMLAttribute {
    $attributes = [];
    foreach ($this->element->attributes($ns, $isPrefix) as $attribute) {
      /** @var \SimpleXMLElement $attribute */
      $attributes[] = new XMLAttributeSimple($attribute);
    }
    return new ArrayMapXMLAttribute($attributes);
  }

  public function attribute(string $name, ?string $ns = null, bool $isPrefix = false): XMLAttribute {
    return $this->attributes($ns, $isPrefix)->get($name) ?: new XMLAttributeStruct($name, null);
  }

  public function children(?string $xpath = null, ?string $ns = null, bool $isPrefix = false): ListXMLElement {
    $elements = [];
    $children = is_null($xpath)
      ? $this->element->children($ns, $isPrefix)
      : $this->element->xpath($xpath);
    foreach ($children as $child) {
      $elements[] = new XMLElementSimple($child);
    }
    return new ArrayListXMLElement($elements);
  }

  public function name(): string {
    return $this->element->getName();
  }

  public function value() {
    return $this->element->__toString();
  }

  public function xml(): string {
    if (empty(trim($this->element->__toString()))
      && $this->children()->isEmpty()) {
      return '';
    }
    return $this->element->asXML();
  }
}
