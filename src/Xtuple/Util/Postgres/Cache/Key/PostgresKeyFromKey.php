<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Key;

use Xtuple\Util\Cache\Key\AbstractKey;
use Xtuple\Util\Cache\Key\KeyStruct;

final class PostgresKeyFromKey
  extends AbstractKey
  implements Key {
  public function id(): string {
    return implode(':', $this->fields());
  }

  public function serialize() {
    return serialize($this->fields());
  }

  public function unserialize($serialized) {
    $this->__construct(new KeyStruct(
      unserialize($serialized, ['allowed_classes' => false])
    ));
  }
}
