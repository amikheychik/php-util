<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response;

use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;
use Xtuple\Util\HTTP\Response\Status\Status;

abstract class AbstractResponse
  implements Response {
  /** @var Response */
  private $response;

  public function __construct(Response $response) {
    $this->response = $response;
  }

  public final function status(): Status {
    return $this->response->status();
  }

  public final function headers(): SetHeader {
    return $this->response->headers();
  }

  public final function body(): Body {
    return $this->response->body();
  }
}
