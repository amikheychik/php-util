<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Collection\Map;

use Xtuple\Util\Collection\Map\ArrayMap\StrictType\AbstractStrictlyTypedArrayMap;
use Xtuple\Util\XML\Attribute\XMLAttribute;

final class ArrayMapXMLAttribute
  extends AbstractStrictlyTypedArrayMap
  implements MapXMLAttribute {
  /**
   * @throws \Throwable - if the element of the wrong type is passed.
   *
   * @param XMLAttribute[] $elements
   */
  public function __construct(array $elements = []) {
    parent::__construct(XMLAttribute::class, $elements, 'name');
  }

  public function __toString(): string {
    $attributes = [];
    foreach ($this as $attribute) {
      /** @var XMLAttribute $attribute */
      $attributes[] = $attribute->__toString();
    }
    return implode(' ', $attributes);
  }

  public function getOptional(XMLAttribute $default): XMLAttribute {
    if ($attribute = $this->get($default->name())) {
      return $attribute;
    }
    return $default;
  }
}
