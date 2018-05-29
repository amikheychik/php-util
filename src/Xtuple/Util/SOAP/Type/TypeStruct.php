<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type;

final class TypeStruct
  implements Type {
  /** @var int */
  private $encoding;
  /** @var string */
  private $name;
  /** @var string */
  private $namespace;

  public function __construct(int $encoding, string $name, string $namespace) {
    $this->encoding = $encoding;
    $this->name = $name;
    $this->namespace = $namespace;
  }

  public function encoding(): int {
    return $this->encoding;
  }

  public function name(): string {
    return $this->name;
  }

  public function namespace(): string {
    return $this->namespace;
  }
}
