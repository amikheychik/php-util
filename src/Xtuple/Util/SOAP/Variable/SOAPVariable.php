<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Variable;

interface SOAPVariable {
  /**
   * @return mixed
   */
  public function value();

  public function variable(): \SoapVar;
}
