<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Record\Value;

interface Bytea {
  public function serialized(): string;

  /**
   * @return mixed
   */
  public function value();
}
