<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String;

use Xtuple\Util\Type\Stream\Stream;
use Xtuple\Util\Type\Stream\String\StringStreamWithContent;
use Xtuple\Util\Type\Stream\TemporaryStream;

final class StringBodyFromString
  implements StringBody {
  /** @var string */
  private $body;

  public function __construct(string $body) {
    $this->body = $body;
  }

  public function __toString(): string {
    return $this->body;
  }

  public function content(): string {
    return $this->body;
  }

  /** @var null|Stream */
  private $stream;

  public function resource() {
    if ($this->stream === null) {
      $this->stream = new StringStreamWithContent(
        new TemporaryStream(),
        (string) $this
      );
    }
    return $this->stream->resource();
  }
}
