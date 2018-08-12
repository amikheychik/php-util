<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Query\Parameter\Table;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\Postgres\PDO\Query\Parameter\Table\RegEx\TableNameRegEx;

final class TableString
  implements Table {
  /** @var string */
  private $name;

  /**
   * @throws Throwable
   *
   * @param string $name
   */
  public function __construct(string $name) {
    if (!(new TableNameRegEx())->matches($name)) {
      throw new Exception('Postgres table can not have `{name}` name', [
        'name' => $name,
      ]);
    }
    $this->name = $name;
  }

  public function __toString(): string {
    return $this->name;
  }
}
