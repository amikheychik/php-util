<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\AbstractList;

abstract class AbstractListRow
  extends AbstractList
  implements ListRow {
  public function __construct(ListRow $rows) {
    parent::__construct($rows);
  }
}
