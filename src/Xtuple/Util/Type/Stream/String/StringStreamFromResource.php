<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream\String;

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Type\Stream\StreamStruct;

final class StringStreamFromResource
  extends AbstractStringStream {
  /**
   * @throws TypeThrowable
   *
   * @param resource $resource
   */
  public function __construct($resource) {
    parent::__construct(new StringStreamStruct(
      new StreamStruct($resource)
    ));
  }
}
