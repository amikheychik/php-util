<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Optional;

use Xtuple\Util\XML\Element\AbstractXMLElement;
use Xtuple\Util\XML\Element\XMLElement;

abstract class AbstractOptionalXMLElement
  extends AbstractXMLElement {
  public function __construct(XMLElement $xml) {
    parent::__construct(new OptionalXMLElement($xml));
  }
}
