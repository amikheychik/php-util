<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD\Numeric;

use Xtuple\Util\SOAP\Type\XSD\AbstractXSDType;
use Xtuple\Util\SOAP\Type\XSD\XSDTypeStruct;

final class XSDInt
  extends AbstractXSDType {
  public function __construct() {
    parent::__construct(new XSDTypeStruct(XSD_INT, 'int'));
  }
}
