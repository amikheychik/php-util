<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Document;

use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\XMLElement;

interface XMLDocument {
  public function __toString(): string;

  public function attributes(): MapXMLAttribute;

  public function root(): XMLElement;

  public function value();
}
