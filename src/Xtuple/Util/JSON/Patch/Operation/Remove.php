<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation;

use Xtuple\Util\JSON\Patch\Operation\Path\Path;

final class Remove
  extends AbstractOperation {
  public function __construct(Path $path) {
    parent::__construct(new OperationStruct('remove', $path, []));
  }
}
