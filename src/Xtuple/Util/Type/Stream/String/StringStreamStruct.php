<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream\String;

use Xtuple\Util\Type\Stream\AbstractStream;
use Xtuple\Util\Type\Stream\Exception\Exception;
use Xtuple\Util\Type\Stream\Exception\Throwable;
use Xtuple\Util\Type\Stream\Stream;

final class StringStreamStruct
  extends AbstractStream
  implements StringStream {
  /** @var Stream */
  private $stream;

  public function __construct(Stream $stream) {
    parent::__construct($stream);
    $this->stream = $stream;
  }

  public function __toString(): string {
    try {
      return $this->content();
    }
    catch (Throwable $e) {
      return '';
    }
  }

  public function content(): string {
    $e = new Exception('Failed to read the resource');
    if (fseek($this->stream->resource(), 0) === 0) {
      $content = stream_get_contents($this->stream->resource());
      if ($content !== false) {
        return $content;
      }
    }
    else {
      $e = new Exception('Failed to seek the resource');
    }
    throw $e;
  }
}
