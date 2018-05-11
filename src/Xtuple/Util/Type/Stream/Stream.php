<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream;

use Xtuple\Util\Type\Stream\Exception\Throwable;

interface Stream {
  /**
   * @throws Throwable
   * @return resource
   */
  public function resource();
}
