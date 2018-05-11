<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body;

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Generics\Type\ResourceType;

final class BodyStream
  implements Body {
  /** @var resource */
  private $stream;

  /**
   * @param resource $stream
   *
   * @throws TypeThrowable
   */
  public function __construct($stream) {
    $this->stream = (new ResourceType())->cast($stream);
  }

  /**
   * @return resource
   */
  public function resource() {
    return $this->stream;
  }
}
