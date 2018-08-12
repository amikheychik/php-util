<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Record;

interface Record
  extends \Xtuple\Util\Cache\Record\Record {
  public function row(): array;
}
