<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Key;

abstract class AbstractKey
  implements Key {
  /** @var Key */
  private $key;

  public function __construct(Key $key) {
    $this->key = $key;
  }

  public final function fields(): array {
    return $this->key->fields();
  }
}
