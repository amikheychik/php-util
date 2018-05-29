<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD;

use Xtuple\Util\SOAP\Element\Element;
use Xtuple\Util\SOAP\Type\XSD\XSDType;

interface XSDElement
  extends Element {
  /**
   * @return XSDType
   */
  public function type();
}
