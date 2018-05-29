<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\XSD\Misc;

use Xtuple\Util\SOAP\Element\XSD\AbstractXSDElement;
use Xtuple\Util\SOAP\Element\XSD\XSDElementStruct;
use Xtuple\Util\SOAP\Type\XSD\Misc\XSDBoolean;

final class XSDBooleanElementStruct
  extends AbstractXSDElement {
  public function __construct(string $name, ?string $namespace, bool $data) {
    parent::__construct(new XSDElementStruct(
      new XSDBoolean(),
      $name,
      $namespace,
      $data
    ));
  }
}
