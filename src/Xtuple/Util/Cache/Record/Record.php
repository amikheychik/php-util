<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Record;

use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\Type\DateTime\DateTime;

interface Record {
  /**
   * @return Key
   * @generic
   */
  public function key();

  /**
   * @return mixed
   * @generic
   */
  public function value();

  public function expiresAt(): ?DateTime;
}
