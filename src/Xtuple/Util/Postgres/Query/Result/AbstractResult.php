<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result;

use Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence\ListRow;

abstract class AbstractResult
  implements Result {
  /** @var Result */
  private $result;

  public function __construct(Result $result) {
    $this->result = $result;
  }

  public final function rows(): ListRow {
    return $this->result->rows();
  }

  public final function affected(): int {
    return $this->result->affected();
  }
}
