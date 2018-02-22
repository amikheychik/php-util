<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Type\Boolean;

use Xtuple\Util\XML\Attribute\AbstractXMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttributeStruct;

final class XMLAttributeBoolean
  extends AbstractXMLAttribute {
  public function __construct(string $name, bool $value) {
    parent::__construct(
      new XMLAttributeStruct($name, $value),
      $value ? 'true' : 'false'
    );
  }
}
