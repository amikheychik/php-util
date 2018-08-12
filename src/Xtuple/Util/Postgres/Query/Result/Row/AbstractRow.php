<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result\Row;

abstract class AbstractRow
  implements Row {
  /** @var Row */
  private $row;

  public function __construct(Row $row) {
    $this->row = $row;
  }

  public final function get(string $column) {
    return $this->row->get($column);
  }
}
