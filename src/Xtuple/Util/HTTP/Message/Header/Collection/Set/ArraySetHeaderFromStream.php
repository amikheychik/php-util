<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use Xtuple\Util\Collection\Set\AbstractSet;
use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Type\Stream\Exception\Throwable as StreamThrowable;
use Xtuple\Util\Type\Stream\String\StringStreamFromResource;

final class ArraySetHeaderFromStream
  extends AbstractSet
  implements SetHeader {
  /**
   * @throws TypeThrowable
   * @throws StreamThrowable
   *
   * @param resource $headers
   */
  public function __construct($headers) {
    parent::__construct(new ArraySetHeaderFromString(
      (new StringStreamFromResource($headers))->content()
    ));
  }
}
