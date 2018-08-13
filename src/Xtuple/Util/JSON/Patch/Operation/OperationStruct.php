<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation;

use Xtuple\Util\JSON\Patch\Operation\Path\Path;

final class OperationStruct
  implements Operation {
  /** @var string */
  private $name;
  /** @var Path */
  private $path;
  /** @var array */
  private $properties;

  public function __construct(string $name, Path $path, array $properties) {
    $this->name = $name;
    $this->path = $path;
    $this->properties = $properties;
  }

  public function jsonSerialize() {
    return [
        'op' => $this->name,
        'path' => $this->path,
      ] + $this->properties;
  }
}
