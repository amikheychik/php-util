<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\XSD;

use Xtuple\Util\SOAP\Type\AbstractType;
use Xtuple\Util\SOAP\Type\TypeStruct;

final class XSDTypeStruct
  extends AbstractType
  implements XSDType {
  public function __construct(int $encoding, string $name) {
    parent::__construct(new TypeStruct($encoding, $name, 'http://www.w3.org/2001/XMLSchema'));
  }
}
