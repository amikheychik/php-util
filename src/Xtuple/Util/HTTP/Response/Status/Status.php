<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status;

use Xtuple\Util\Type\String\Chars;

interface Status
  extends Chars {
  public function version(): string;

  public function code(): int;

  public function reason(): string;
}
