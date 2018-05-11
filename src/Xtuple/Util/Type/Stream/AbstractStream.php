<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream;

abstract class AbstractStream
  implements Stream {
  /** @var Stream */
  private $stream;

  public function __construct(Stream $stream) {
    $this->stream = $stream;
  }

  public final function resource() {
    return $this->stream->resource();
  }
}
