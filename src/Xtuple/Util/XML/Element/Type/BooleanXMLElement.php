<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type;

use Xtuple\Util\XML\Element\XMLElement;

final class BooleanXMLElement {
  /** @var XMLElement */
  private $element;

  public function __construct(XMLElement $element) {
    $this->element = $element;
  }

  public function value(): bool {
    return strtolower($this->element->value()) === 'true';
  }
}
