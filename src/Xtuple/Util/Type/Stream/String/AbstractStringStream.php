<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream\String;

use Xtuple\Util\Type\Stream\AbstractStream;

abstract class AbstractStringStream
  extends AbstractStream
  implements StringStream {
  /** @var StringStream */
  private $stream;

  public function __construct(StringStream $stream) {
    parent::__construct($stream);
    $this->stream = $stream;
  }

  public final function __toString(): string {
    return $this->stream->__toString();
  }

  public final function content(): string {
    return $this->stream->content();
  }
}
