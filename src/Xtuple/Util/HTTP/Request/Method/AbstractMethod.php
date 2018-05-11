<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Method;

abstract class AbstractMethod
  implements Method {
  /** @var Method */
  private $method;

  public function __construct(Method $method) {
    $this->method = $method;
  }

  public final function __toString(): string {
    return $this->method->__toString();
  }
}
