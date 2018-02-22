<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Optional;

use Xtuple\Util\XML\Attribute\AbstractXMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttribute;

abstract class AbstractOptionalXMLAttribute
  extends AbstractXMLAttribute {
  public function __construct(XMLAttribute $attribute) {
    parent::__construct(new OptionalXMLAttribute($attribute));
  }
}
