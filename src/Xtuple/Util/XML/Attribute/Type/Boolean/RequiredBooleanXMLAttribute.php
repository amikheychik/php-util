<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Type\Boolean;

use Xtuple\Util\XML\Attribute\XMLAttribute;

final class RequiredBooleanXMLAttribute
  implements BooleanXMLAttribute {
  /** @var XMLAttribute */
  private $attribute;

  public function __construct(XMLAttribute $attribute) {
    $this->attribute = $attribute;
  }

  public function name(): string {
    return $this->attribute->name();
  }

  public function value() {
    return strtolower($this->attribute->value()) === 'true';
  }
}
