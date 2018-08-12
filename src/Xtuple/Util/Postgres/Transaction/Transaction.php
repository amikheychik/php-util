<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Transaction;

use Xtuple\Util\Postgres\Database;

interface Transaction {
  public function run(Database $database);
}
