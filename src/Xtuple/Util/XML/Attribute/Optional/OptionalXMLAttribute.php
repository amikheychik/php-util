<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Optional;

use Xtuple\Util\XML\Attribute\XMLAttribute;

final class OptionalXMLAttribute
  implements XMLAttribute {
  /** @var XMLAttribute */
  private $attribute;

  public function __construct(XMLAttribute $attribute) {
    $this->attribute = $attribute;
  }

  public function __toString(): string {
    return $this->attribute->value()
      ? $this->attribute->__toString()
      : '';
  }

  public function name(): string {
    return $this->attribute->name();
  }

  public function value() {
    return $this->attribute->value();
  }
}
