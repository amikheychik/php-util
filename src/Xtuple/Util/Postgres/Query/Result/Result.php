<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result;

use Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence\ListRow;

interface Result {
  public function rows(): ListRow;

  public function affected(): int;
}
