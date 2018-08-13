<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation;

abstract class AbstractOperation
  implements Operation {
  /** @var Operation */
  private $operation;

  public function __construct(Operation $operation) {
    $this->operation = $operation;
  }

  public final function jsonSerialize() {
    return $this->operation->jsonSerialize();
  }
}
