<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim;

final class ClaimStruct
  implements Claim {
  /** @var string */
  private $name;
  /** @var mixed */
  private $value;

  /**
   * @param string $name
   * @param mixed  $value
   */
  public function __construct(string $name, $value) {
    $this->name = $name;
    $this->value = $value;
  }

  public function __toString(): string {
    return "{$this->name}: {$this->value}";
  }

  public function name(): string {
    return $this->name;
  }

  public function value() {
    return $this->value;
  }
}
