<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Request;

use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;
use Xtuple\Util\HTTP\Request\AbstractRequest;
use Xtuple\Util\HTTP\Request\Method\Method\GET;
use Xtuple\Util\HTTP\Request\RequestStruct;
use Xtuple\Util\HTTP\Request\URI\URI;

final class GETRequest
  extends AbstractRequest {
  public function __construct(URI $uri, ?SetHeader $headers = null, ?Body $body = null) {
    parent::__construct(new RequestStruct(new GET(), $uri, $headers, $body));
  }
}
