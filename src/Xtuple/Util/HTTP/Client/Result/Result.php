<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Result;

use Xtuple\Util\HTTP\Response\Response;

interface Result {
  public function key(): string;

  /**
   * @throws \Throwable
   * @return Response
   */
  public function response(): Response;
}
