<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header;

abstract class AbstractHeader
  implements Header {
  /** @var Header */
  private $header;

  public function __construct(Header $header) {
    $this->header = $header;
  }

  public final function __toString(): string {
    return $this->header->__toString();
  }

  public final function name(): string {
    return $this->header->name();
  }

  public final function value(): string {
    return $this->header->value();
  }
}
