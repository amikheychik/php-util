<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element;

use Xtuple\Util\SOAP\Variable\SOAPVariable;

abstract class AbstractElement
  implements Element {
  /** @var Element */
  private $element;

  public function __construct(Element $element) {
    $this->element = $element;
  }

  public final function type() {
    return $this->element->type();
  }

  public final function name(): string {
    return $this->element->name();
  }

  public final function namespace(): ?string {
    return $this->element->namespace();
  }

  public final function soap(): SOAPVariable {
    return $this->element->soap();
  }
}
