<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Type\Boolean;

use Xtuple\Util\XML\Attribute\XMLAttribute;

interface BooleanXMLAttribute
  extends XMLAttribute {
  /**
   * @return bool
   */
  public function value();
}
