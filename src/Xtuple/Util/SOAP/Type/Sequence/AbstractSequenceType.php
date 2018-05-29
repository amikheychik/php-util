<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\Sequence;

use Xtuple\Util\SOAP\Type\AbstractType;

abstract class AbstractSequenceType
  extends AbstractType
  implements SequenceType {
  public function __construct(SequenceType $type) {
    parent::__construct($type);
  }
}
