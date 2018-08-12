<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\Postgres\Query\Query;
use Xtuple\Util\Postgres\Query\Result\Result;
use Xtuple\Util\Postgres\Transaction\Transaction;

interface Database
  extends \Serializable {
  /**
   * @throws Throwable
   *
   * @param Query $query
   *
   * @return Result
   */
  public function query(Query $query): Result;

  /**
   * @throws Throwable
   *
   * @param Transaction $transaction
   *
   * @return mixed
   */
  public function transaction(Transaction $transaction);
}
