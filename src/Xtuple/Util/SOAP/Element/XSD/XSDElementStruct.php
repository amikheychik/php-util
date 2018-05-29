<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD;

use Xtuple\Util\SOAP\Element\AbstractElement;
use Xtuple\Util\SOAP\Element\ElementStruct;
use Xtuple\Util\SOAP\Type\XSD\XSDType;

final class XSDElementStruct
  extends AbstractElement
  implements XSDElement {
  /**
   * @param XSDType     $type
   * @param string      $name
   * @param null|string $namespace
   * @param mixed       $data
   */
  public function __construct(XSDType $type, string $name, ?string $namespace, $data) {
    parent::__construct(new ElementStruct($type, $name, $namespace, $data));
  }
}
