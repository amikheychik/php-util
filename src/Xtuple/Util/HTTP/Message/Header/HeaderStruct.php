<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header;

final class HeaderStruct
  implements Header {
  /** @var string */
  private $name;
  /** @var string */
  private $value;

  public function __construct(string $name, string $value) {
    $this->name = $name;
    $this->value = $value;
  }

  public function __toString(): string {
    return "{$this->name}: {$this->value}";
  }

  public function name(): string {
    return $this->name;
  }

  public function value(): string {
    return $this->value;
  }
}
