<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\Sequence;

use Xtuple\Util\SOAP\Element\AbstractElement;

abstract class AbstractSequenceElement
  extends AbstractElement
  implements SequenceElement {
  public function __construct(SequenceElement $element) {
    parent::__construct($element);
  }
}
