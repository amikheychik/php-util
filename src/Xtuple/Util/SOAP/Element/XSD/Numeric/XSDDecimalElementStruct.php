<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD\Numeric;

use Xtuple\Util\SOAP\Element\XSD\AbstractXSDElement;
use Xtuple\Util\SOAP\Element\XSD\XSDElementStruct;
use Xtuple\Util\SOAP\Type\XSD\Numeric\XSDDecimal;

final class XSDDecimalElementStruct
  extends AbstractXSDElement {
  public function __construct(string $name, ?string $namespace, float $data) {
    parent::__construct(new XSDElementStruct(
      new XSDDecimal(),
      $name,
      $namespace,
      $data
    ));
  }
}
