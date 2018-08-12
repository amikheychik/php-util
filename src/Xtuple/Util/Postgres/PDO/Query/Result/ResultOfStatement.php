<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Query\Result;

use Xtuple\Util\Postgres\PDO\Query\Result\Row\RowStdClass;
use Xtuple\Util\Postgres\Query\Result\AbstractResult;
use Xtuple\Util\Postgres\Query\Result\ResultStruct;
use Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence\ArrayListRow;

final class ResultOfStatement
  extends AbstractResult {
  public function __construct(\PDOStatement $statement) {
    $rows = [];
    foreach ($statement->fetchAll(\PDO::FETCH_CLASS) as $row) {
      $rows[] = new RowStdClass($row);
    }
    /** @noinspection PhpUnhandledExceptionInspection */
    parent::__construct(new ResultStruct(
      new ArrayListRow($rows),
      $statement->rowCount()
    ));
  }
}
