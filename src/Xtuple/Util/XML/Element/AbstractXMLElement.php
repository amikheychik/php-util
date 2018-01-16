<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;

abstract class AbstractXMLElement
  implements XMLElement {
  /** @var XMLElement */
  private $xml;

  public function __construct(XMLElement $xml) {
    $this->xml = $xml;
  }

  public final function attributes(?string $ns = null, bool $isPrefix = false): MapXMLAttribute {
    return $this->xml->attributes($ns, $isPrefix);
  }

  public final function attribute(string $name, ?string $ns = null, bool $isPrefix = false): XMLAttribute {
    return $this->xml->attribute($name, $ns, $isPrefix);
  }

  public final function children(?string $xpath = null, ?string $ns = null, bool $isPrefix = false): ListXMLElement {
    return $this->xml->children($xpath, $ns, $isPrefix);
  }

  public final function name(): string {
    return $this->xml->name();
  }

  public final function value() {
    return $this->xml->value();
  }

  public final function xml(): string {
    return $this->xml->xml();
  }
}
