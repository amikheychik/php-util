<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD\String;

use Xtuple\Util\SOAP\Element\XSD\AbstractXSDElement;
use Xtuple\Util\SOAP\Element\XSD\XSDElementStruct;
use Xtuple\Util\SOAP\Type\XSD\String\XSDString;

final class XSDStringElementStruct
  extends AbstractXSDElement {
  public function __construct(string $name, ?string $namespace, string $data) {
    parent::__construct(new XSDElementStruct(
      new XSDString(),
      $name,
      $namespace,
      $data
    ));
  }
}
