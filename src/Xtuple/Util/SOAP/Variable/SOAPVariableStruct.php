<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Variable;

final class SOAPVariableStruct
  implements SOAPVariable {
  /** @var \SoapVar */
  private $soap;

  public function __construct(\SoapVar $soap) {
    $this->soap = $soap;
  }

  public function value() {
    /** @noinspection PhpUndefinedFieldInspection */
    return $this->soap->enc_value;
  }

  public function variable(): \SoapVar {
    return $this->soap;
  }
}
