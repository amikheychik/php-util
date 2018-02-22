<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Optional;

use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;
use Xtuple\Util\XML\Element\XMLElement;

final class OptionalXMLElement
  implements XMLElement {
  /** @var XMLElement */
  private $element;

  public function __construct(XMLElement $element) {
    $this->element = $element;
  }

  public function __toString(): string {
    return $this->element->isEmpty() ? '' : $this->element->__toString();
  }

  public function name(): string {
    return $this->element->name();
  }

  public function attributes(?string $ns = null, bool $isPrefix = false): MapXMLAttribute {
    return $this->element->attributes($ns, $isPrefix);
  }

  public function children(?string $xpath = null, ?string $ns = null, bool $isPrefix = false): ListXMLElement {
    return $this->element->children($xpath, $ns, $isPrefix);
  }

  public function value() {
    return $this->element->value();
  }

  public function isEmpty(): bool {
    return $this->element->isEmpty();
  }
}
