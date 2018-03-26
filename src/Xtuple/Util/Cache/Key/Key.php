<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Key;

interface Key {
  /**
   * @return string[]
   */
  public function fields(): array;
}
