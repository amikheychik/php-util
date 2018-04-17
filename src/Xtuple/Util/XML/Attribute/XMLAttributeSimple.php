<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute;

use Xtuple\Util\Exception\Exception;

final class XMLAttributeSimple
  implements XMLAttribute {
  /** @var \SimpleXMLElement */
  private $element;

  /**
   * @throws \Throwable
   *
   * @param \SimpleXMLElement $element
   */
  public function __construct(\SimpleXMLElement $element) {
    if ($element->attributes()->getName() !== '') {
      throw new Exception('Passed element `{name}` is not an attribute.', [
        'name' => $element->getName(),
      ]);
    }
    $this->element = $element;
  }

  public function __toString(): string {
    return strtr('{name}="{value}"', [
      '{name}' => $this->name(),
      '{value}' => $this->value(),
    ]);
  }

  public function name(): string {
    return $this->element->getName();
  }

  public function value() {
    return $this->element->__toString();
  }
}
