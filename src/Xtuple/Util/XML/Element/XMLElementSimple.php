<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\XML\Attribute\Collection\Map\ArrayMapXMLAttribute;
use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttributeSimple;
use Xtuple\Util\XML\Element\Collection\Sequence\ArrayListXMLElement;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;

final class XMLElementSimple
  implements XMLElement {
  /** @var \SimpleXMLElement */
  private $element;

  /**
   * @throws \Throwable
   *
   * @param \SimpleXMLElement $element
   */
  public function __construct(\SimpleXMLElement $element) {
    if (is_null($element->attributes())) {
      throw new Exception('Passed element is an attribute.');
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

  public function __toString(): string {
    return trim(preg_replace("/^<\\?xml.*\\?>\n/", '', $this->element->asXML()));
  }

  public function name(): string {
    return $this->element->getName();
  }

  public function attributes(?string $ns = null, bool $isPrefix = false): MapXMLAttribute {
    $attributes = [];
    foreach ($this->element->attributes($ns, $isPrefix) as $attribute) {
      /** @var \SimpleXMLElement $attribute */
      /** @noinspection PhpUnhandledExceptionInspection - \SimpleXMLElement::attributes() returns attributes only */
      $attributes[] = new XMLAttributeSimple($attribute);
    }
    /** @noinspection PhpUnhandledExceptionInspection - verified XMLAttribute type */
    return new ArrayMapXMLAttribute($attributes);
  }

  public function children(?string $xpath = null, ?string $ns = null, bool $isPrefix = false): ListXMLElement {
    $elements = [];
    $children = is_null($xpath)
      ? $this->element->children($ns, $isPrefix)
      : $this->element->xpath($xpath);
    foreach ($children as $child) {
      /** @noinspection PhpUnhandledExceptionInspection - XML should be valid */
      $elements[] = new XMLElementString($child->asXML());
    }
    /** @noinspection PhpUnhandledExceptionInspection - should be an XMLElement */
    return new ArrayListXMLElement($elements);
  }

  public function value() {
    return $this->element->__toString();
  }

  public function isEmpty(): bool {
    return (
      empty($this->value())
      && $this->attributes()->isEmpty()
      && $this->children()->isEmpty()
    );
  }
}
