<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\Type\Stream\String\StringStreamFromResource;

final class StatusFromStream
  extends AbstractStatus {
  /**
   * @param resource $stream
   *
   * @throws Throwable
   */
  public function __construct($stream) {
    parent::__construct(new StatusString(
      (new StringStreamFromResource($stream))->content()
    ));
  }
}
