<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Key;

interface Key
  extends \Xtuple\Util\Cache\Key\Key,
          \Serializable {
  public function id(): string;
}
