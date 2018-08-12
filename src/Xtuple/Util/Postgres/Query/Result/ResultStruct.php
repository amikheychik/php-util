<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result;

use Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence\ListRow;

final class ResultStruct
  implements Result {
  /** @var ListRow */
  private $rows;
  /** @var int */
  private $affected;

  public function __construct(ListRow $rows, int $affected) {
    $this->rows = $rows;
    $this->affected = $affected;
  }

  public function rows(): ListRow {
    return $this->rows;
  }

  public function affected(): int {
    return $this->affected;
  }
}
