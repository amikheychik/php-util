<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body;

abstract class AbstractBody
  implements Body {
  /** @var Body */
  private $body;

  public function __construct(Body $body) {
    $this->body = $body;
  }

  public final function resource() {
    return $this->body->resource();
  }
}
