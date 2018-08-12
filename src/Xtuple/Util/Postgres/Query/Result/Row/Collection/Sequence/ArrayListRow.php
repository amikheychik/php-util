<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\ArrayList\StrictType\AbstractStrictlyTypedArrayList;
use Xtuple\Util\Postgres\Query\Result\Row\Row;

final class ArrayListRow
  extends AbstractStrictlyTypedArrayList
  implements ListRow {
  /**
   * @throws \Throwable
   *
   * @param iterable|Row[] $elements
   */
  public function __construct(iterable $elements = []) {
    parent::__construct(Row::class, $elements);
  }
}
