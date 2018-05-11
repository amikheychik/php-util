<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Collection\Map;

use Xtuple\Util\Collection\Map\ArrayMap\StrictType\AbstractStrictlyTypedArrayMap;
use Xtuple\Util\HTTP\Request\Request;

final class ArrayMapRequest
  extends AbstractStrictlyTypedArrayMap
  implements MapRequest {
  /**
   * @throws \Throwable
   *
   * @param Request[]|iterable $requests
   */
  public function __construct(iterable $requests) {
    parent::__construct(Request::class, $requests);
  }
}
