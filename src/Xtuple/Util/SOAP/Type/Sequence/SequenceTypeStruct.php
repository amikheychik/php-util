<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type\Sequence;

use Xtuple\Util\SOAP\Type\AbstractType;
use Xtuple\Util\SOAP\Type\TypeStruct;

final class SequenceTypeStruct
  extends AbstractType
  implements SequenceType {
  public function __construct(string $type, string $namespace) {
    parent::__construct(new TypeStruct(SOAP_ENC_ARRAY, $type, $namespace));
  }
}
