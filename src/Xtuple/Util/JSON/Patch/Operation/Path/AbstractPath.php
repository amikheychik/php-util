<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation\Path;

abstract class AbstractPath
  implements Path {
  /** @var Path */
  private $path;

  public function __construct(Path $path) {
    $this->path = $path;
  }

  public final function jsonSerialize() {
    return $this->path->jsonSerialize();
  }

  public final function value(): string {
    return $this->path->value();
  }
}
