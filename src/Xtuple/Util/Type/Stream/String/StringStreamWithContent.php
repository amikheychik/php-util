<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream\String;

use Xtuple\Util\Type\Stream\Exception\Exception;
use Xtuple\Util\Type\Stream\Exception\Throwable;
use Xtuple\Util\Type\Stream\Stream;

final class StringStreamWithContent
  extends AbstractStringStream {
  /**
   * @throws Throwable
   *
   * @param Stream $stream
   * @param string $content
   */
  public function __construct(Stream $stream, string $content) {
    if (fwrite($stream->resource(), $content) === false) {
      throw new Exception('Failed to write content into stream');
    }
    parent::__construct(new StringStreamStruct($stream));
  }
}
