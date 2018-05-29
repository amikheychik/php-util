<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD;

use Xtuple\Util\SOAP\Element\AbstractElement;

abstract class AbstractXSDElement
  extends AbstractElement
  implements XSDElement {
  public function __construct(XSDElement $element) {
    parent::__construct($element);
  }
}
