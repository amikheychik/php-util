<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Client\CURL\Exception\CURLException;
use Xtuple\Util\HTTP\Response\Response;

interface Handle {
  public function key(): string;

  /**
   * @return resource
   */
  public function handle();

  /**
   * @throws CURLException
   * @throws Throwable
   * @return Response
   */
  public function response(): Response;
}
