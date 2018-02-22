<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type\Boolean;

use Xtuple\Util\XML\Element\Type\AbstractTypeXMLElement;
use Xtuple\Util\XML\Element\XMLElement;

final class BooleanXMLElement
  extends AbstractTypeXMLElement {
  /** @var XMLElement */
  private $element;

  public function __construct(XMLElement $element) {
    parent::__construct($element);
    $this->element = $element;
  }

  /**
   * @return bool
   */
  public function value() {
    return strtolower($this->element->value()) === 'true';
  }
}
