<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD;

use Xtuple\Util\SOAP\Type\AbstractType;

abstract class AbstractXSDType
  extends AbstractType
  implements XSDType {
  public function __construct(XSDType $type) {
    parent::__construct($type);
  }
}
