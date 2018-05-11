<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Generics\Type\Exception\ValueTypeException;

final class ResourceType
  implements Type {
  /**
   * @throws TypeThrowable
   *
   * @param resource $instance
   *
   * @return resource
   */
  public function cast($instance) {
    if (!is_resource($instance)) {
      throw new ValueTypeException('resource', (new CastType($instance))->fqn());
    }
    return $instance;
  }
}
