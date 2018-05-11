<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response;

use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;
use Xtuple\Util\HTTP\Response\Status\Status;

final class ResponseStruct
  implements Response {
  /** @var Status */
  private $status;
  /** @var SetHeader */
  private $headers;
  /** @var Body */
  private $body;

  public function __construct(Status $status, SetHeader $headers, Body $body) {
    $this->status = $status;
    $this->headers = $headers;
    $this->body = $body;
  }

  public function status(): Status {
    return $this->status;
  }

  public function headers(): SetHeader {
    return $this->headers;
  }

  public function body(): Body {
    return $this->body;
  }
}
