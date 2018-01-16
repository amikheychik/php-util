<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Collection\Map;

use Xtuple\Util\Collection\Map\ArrayMap\StrictType\AbstractStrictlyTypedArrayMap;
use Xtuple\Util\XML\Attribute\XMLAttribute;

final class ArrayMapXMLAttribute
  extends AbstractStrictlyTypedArrayMap
  implements MapXMLAttribute {
  /**
   * @param XMLAttribute[] $elements
   */
  public function __construct(array $elements = []) {
    parent::__construct(XMLAttribute::class, $elements, 'name');
  }
}
