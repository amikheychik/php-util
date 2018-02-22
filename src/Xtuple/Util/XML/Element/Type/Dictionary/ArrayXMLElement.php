<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type\Dictionary;

use Xtuple\Util\XML\Element\XMLElement;

final class ArrayXMLElement {
  /** @var XMLElement */
  private $element;
  /** @var string|null */
  private $ns;
  /** @var bool */
  private $isPrefix;

  public function __construct(XMLElement $element, ?string $ns = null, bool $isPrefix = false) {
    $this->element = $element;
    $this->ns = $ns;
    $this->isPrefix = $isPrefix;
  }

  /**
   * @return array
   */
  public function value() {
    $value = [];
    if (trim($this->element->value())) {
      return trim($this->element->value());
    }
    foreach ($this->element->attributes($this->ns, $this->isPrefix) as $attribute) {
      $value[$attribute->name()] = $attribute->value();
    }
    foreach ($this->element->children(null, $this->ns, $this->isPrefix) as $child) {
      $value[$child->name()] = (new ArrayXMLElement($child))->value();
    }
    return $value;
  }
}
