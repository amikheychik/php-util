<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query\Result\Row\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\Sequence;
use Xtuple\Util\Postgres\Query\Result\Row\Row;

interface ListRow
  extends Sequence {
  /**
   * @param int $key
   *
   * @return null|Row
   */
  public function get(int $key);

  /**
   * @return null|Row
   */
  public function current();
}
