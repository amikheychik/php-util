<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Type\Boolean;

use Xtuple\Util\XML\Attribute\XMLAttribute;

final class OptionalBooleanXMLAttribute
  implements XMLAttribute {
  /** @var XMLAttribute */
  private $attribute;
  /** @var bool */
  private $default;

  public function __construct(XMLAttribute $attribute, bool $default) {
    $this->attribute = $attribute;
    $this->default = $default;
  }

  public function name(): string {
    return $this->attribute->name();
  }

  public function value() {
    return $this->attribute->value() ? strtolower($this->attribute->value()) === 'true' : $this->default;
  }
}
