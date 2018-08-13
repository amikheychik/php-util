<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation;

use Xtuple\Util\JSON\Patch\Operation\Path\Path;

final class Replace
  extends AbstractOperation {
  /**
   * @param Path  $path
   * @param mixed $value
   */
  public function __construct($path, $value) {
    parent::__construct(new OperationStruct('replace', $path, [
      'value' => $value,
    ]));
  }
}
