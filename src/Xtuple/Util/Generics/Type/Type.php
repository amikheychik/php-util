<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

interface Type {
  /**
   * @throws \Throwable
   *
   * @param mixed $instance
   *
   * @return mixed - original object, if type is correct
   */
  public function cast($instance);
}
