<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Method;

final class MethodString
  implements Method {
  /** @var string */
  private $method;

  public function __construct(string $method) {
    $this->method = $method;
  }

  public function __toString(): string {
    return $this->method;
  }
}
