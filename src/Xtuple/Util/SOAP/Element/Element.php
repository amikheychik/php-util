<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element;

use Xtuple\Util\SOAP\Type\Type;
use Xtuple\Util\SOAP\Variable\SOAPVariable;

interface Element {
  /**
   * @return Type
   */
  public function type();

  public function name(): string;

  public function namespace(): ?string;

  public function soap(): SOAPVariable;
}
