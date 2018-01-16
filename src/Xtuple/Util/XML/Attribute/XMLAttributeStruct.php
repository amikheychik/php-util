<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute;

final class XMLAttributeStruct
  implements XMLAttribute {
  /** @var string */
  private $name;
  /** @var mixed */
  private $value;

  public function __construct(string $name, $value) {
    $this->name = $name;
    $this->value = $value;
  }

  public function name(): string {
    return $this->name;
  }

  public function value() {
    return $this->value;
  }
}
