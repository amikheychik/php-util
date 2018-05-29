<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD\Misc;

use Xtuple\Util\SOAP\Type\XSD\AbstractXSDType;
use Xtuple\Util\SOAP\Type\XSD\XSDTypeStruct;

final class XSDBoolean
  extends AbstractXSDType {
  public function __construct() {
    parent::__construct(new XSDTypeStruct(XSD_BOOLEAN, 'boolean'));
  }
}
