<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation;

use Xtuple\Util\JSON\Patch\Operation\Path\Path;

final class Add
  extends AbstractOperation {
  /**
   * @param Path  $path
   * @param mixed $value
   */
  public function __construct(Path $path, $value) {
    parent::__construct(new OperationStruct('add', $path, [
      'value' => $value,
    ]));
  }
}
