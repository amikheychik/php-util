<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client;

use Xtuple\Util\HTTP\Client\Exception\Throwable;
use Xtuple\Util\HTTP\Client\Result\Collection\Map\MapResult;
use Xtuple\Util\HTTP\Client\Result\Result;
use Xtuple\Util\HTTP\Request\Collection\Map\MapRequest;
use Xtuple\Util\HTTP\Request\Request;

interface Client {
  public function send(Request $request): Result;

  /**
   * @throws Throwable
   *
   * @param MapRequest $requests
   *
   * @return MapResult
   */
  public function sendMany(MapRequest $requests): MapResult;
}
