<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\ArrayList\StrictType\AbstractStrictlyTypedArrayList;
use Xtuple\Util\XML\Element\XMLElement;

final class ArrayListXMLElement
  extends AbstractStrictlyTypedArrayList
  implements ListXMLElement {
  /**
   * @param XMLElement[] $elements
   */
  public function __construct(array $elements = []) {
    parent::__construct(XMLElement::class, $elements);
  }
}
