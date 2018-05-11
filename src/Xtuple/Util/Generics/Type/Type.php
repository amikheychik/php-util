<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;

interface Type {
  /**
   * @throws TypeThrowable
   *
   * @param mixed $instance
   *
   * @return mixed - original object, if type is correct
   */
  public function cast($instance);
}
