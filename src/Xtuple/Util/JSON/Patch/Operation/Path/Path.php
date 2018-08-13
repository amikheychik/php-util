<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation\Path;

interface Path
  extends \JsonSerializable {
  public function value(): string;
}
