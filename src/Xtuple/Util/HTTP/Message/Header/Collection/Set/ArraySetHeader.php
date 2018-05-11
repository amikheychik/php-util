<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use Xtuple\Util\Collection\Set\ArraySet\StrictType\AbstractStrictlyTypedArraySet;
use Xtuple\Util\HTTP\Message\Header\Header;

final class ArraySetHeader
  extends AbstractStrictlyTypedArraySet
  implements SetHeader {
  /**
   * @throws \Throwable - if $elements contain an element of a wrong type
   *
   * @param Header[]|iterable $headers
   */
  public function __construct(iterable $headers = []) {
    parent::__construct(Header::class, $headers, 'name');
  }
}
