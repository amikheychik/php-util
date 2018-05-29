<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\Sequence;

use Xtuple\Util\SOAP\Element\AbstractElement;
use Xtuple\Util\SOAP\Element\Element;
use Xtuple\Util\SOAP\Element\ElementStruct;
use Xtuple\Util\SOAP\Type\Sequence\SequenceType;

final class SequenceElementStruct
  extends AbstractElement
  implements SequenceElement {
  public function __construct(SequenceType $type, string $name, ?string $namespace, Element ...$elements) {
    $data = [];
    foreach ($elements as $element) {
      if (isset($data[$element->name()])) {
        if (!is_array($data[$element->name()])) {
          $data[$element->name()] = [
            $data[$element->name()],
          ];
        }
        $data[$element->name()][] = $element->soap()->variable();
      }
      else {
        $data[$element->name()] = $element->soap()->variable();
      }
    }
    parent::__construct(new ElementStruct($type, $name, $namespace, $data));
  }
}
