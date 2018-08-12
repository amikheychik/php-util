<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Query\Result\Row;

use Xtuple\Util\Postgres\Query\Result\Row\Row;

final class RowStdClass
  implements Row {
  /** @var \stdClass */
  private $row;

  public function __construct(\stdClass $row) {
    $this->row = $row;
  }

  public function get(string $column) {
    return $this->row->{$column} ?? null;
  }
}
