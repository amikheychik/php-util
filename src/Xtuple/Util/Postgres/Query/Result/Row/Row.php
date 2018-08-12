<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result\Row;

interface Row {
  public function get(string $column);
}
