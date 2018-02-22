<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type;

use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;
use Xtuple\Util\XML\Element\XMLElement;

abstract class AbstractTypeXMLElement
  implements XMLElement {
  /** @var XMLElement */
  private $xml;

  public function __construct(XMLElement $xml) {
    $this->xml = $xml;
  }

  public final function __toString(): string {
    return $this->xml->__toString();
  }

  public final function name(): string {
    return $this->xml->name();
  }

  public final function attributes(?string $ns = null, bool $isPrefix = false): MapXMLAttribute {
    return $this->xml->attributes($ns, $isPrefix);
  }

  public final function children(?string $xpath = null, ?string $ns = null, bool $isPrefix = false): ListXMLElement {
    return $this->xml->children($xpath, $ns, $isPrefix);
  }

  public final function isEmpty(): bool {
    return $this->xml->isEmpty();
  }
}
