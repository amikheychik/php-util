<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Query\Parameter\Table\RegEx;

use Xtuple\Util\RegEx\AbstractRegEx;
use Xtuple\Util\RegEx\RegExPattern;

final class TableNameRegEx
  extends AbstractRegEx {
  public function __construct() {
    parent::__construct(new RegExPattern('/^[A-Za-z][A-Za-z_0-9]*$/'));
  }
}
