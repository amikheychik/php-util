<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream;

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Generics\Type\ResourceType;

final class StreamStruct
  implements Stream {
  /** @var resource */
  private $resource;

  /**
   * @param resource $resource
   *
   * @throws TypeThrowable
   */
  public function __construct($resource) {
    $this->resource = (new ResourceType())->cast($resource);
  }

  public function resource() {
    return $this->resource;
  }
}
