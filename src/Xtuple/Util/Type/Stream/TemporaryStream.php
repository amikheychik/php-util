<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream;

use Xtuple\Util\Type\Stream\Exception\Exception;
use Xtuple\Util\Type\Stream\Exception\Throwable;

final class TemporaryStream
  extends AbstractStream {
  /**
   * @throws Throwable
   */
  public function __construct() {
    $resource = tmpfile();
    if ($resource === false) {
      // @codeCoverageIgnoreStart
      // Unable to reproduce it locally
      throw new Exception('Failed to create a temporary stream');
      // @codeCoverageIgnoreEnd
    }
    /** @noinspection PhpUnhandledExceptionInspection - $resource type is verified */
    parent::__construct(new StreamStruct($resource));
  }
}
