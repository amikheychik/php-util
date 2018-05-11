<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Multi;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\MapResult;

interface MultiHandle {
  /**
   * @throws Throwable
   * @return MapResult
   */
  public function execute(): MapResult;
}
