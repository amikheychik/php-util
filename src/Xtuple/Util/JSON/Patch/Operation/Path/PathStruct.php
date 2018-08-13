<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation\Path;

final class PathStruct
  implements Path {
  /** @var string */
  private $path;

  public function __construct(string $path) {
    $this->path = $path;
  }

  public function jsonSerialize() {
    return $this->path;
  }

  public function value(): string {
    return $this->path;
  }
}
