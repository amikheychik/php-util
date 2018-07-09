<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute;

abstract class AbstractXMLAttribute
  implements XMLAttribute {
  /** @var XMLAttribute */
  private $attribute;
  /** @var null|string */
  private $value;

  public function __construct(XMLAttribute $attribute, ?string $value = null) {
    $this->attribute = $attribute;
    $this->value = $value;
  }

  public final function __toString(): string {
    return $this->value === null
      ? $this->attribute->__toString()
      : strtr('{name}="{value}"', [
        '{name}' => $this->attribute->name(),
        '{value}' => $this->value,
      ]);
  }

  public final function name(): string {
    return $this->attribute->name();
  }

  public final function value() {
    return $this->attribute->value();
  }
}
