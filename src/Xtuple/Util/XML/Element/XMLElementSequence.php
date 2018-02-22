<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use Xtuple\Util\XML\Attribute\Collection\Map\ArrayMapXMLAttribute;
use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;

final class XMLElementSequence
  implements XMLElement {
  /** @var ListXMLElement */
  private $elements;

  public function __construct(ListXMLElement $elements) {
    $this->elements = $elements;
  }

  public function __toString(): string {
    return $this->elements->__toString();
  }

  public function name(): string {
    return '';
  }

  public function attributes(?string $ns = null, bool $isPrefix = false): MapXMLAttribute {
    return new ArrayMapXMLAttribute();
  }

  public function children(?string $xpath = null, ?string $ns = null, bool $isPrefix = false): ListXMLElement {
    return (new XMLElementString(strtr('<Root>{sequence}</Root>', [
      '{sequence}' => $this,
    ])))->children($xpath, $ns, $isPrefix);
  }

  public function value() {
    return '';
  }

  public function isEmpty(): bool {
    return $this->elements->isEmpty();
  }
}
