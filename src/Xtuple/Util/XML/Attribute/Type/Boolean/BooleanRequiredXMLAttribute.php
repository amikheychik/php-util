<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Type\Boolean;

use Xtuple\Util\XML\Attribute\AbstractXMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttribute;

final class BooleanRequiredXMLAttribute
  extends AbstractXMLAttribute
  implements BooleanXMLAttribute {
  public function __construct(XMLAttribute $attribute) {
    parent::__construct(new XMLAttributeBoolean(
      $attribute->name(),
      is_bool($attribute->value())
        ? $attribute->value()
        : strtolower($attribute->value()) === 'true'
    ));
  }
}
