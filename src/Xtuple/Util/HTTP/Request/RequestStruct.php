<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request;

use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromString;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;
use Xtuple\Util\HTTP\Request\Method\Method;
use Xtuple\Util\HTTP\Request\URI\URI;

final class RequestStruct
  implements Request {
  /** @var Method */
  private $method;
  /** @var URI */
  private $url;
  /** @var SetHeader */
  private $headers;
  /** @var Body */
  private $body;

  public function __construct(Method $method, URI $uri, ?SetHeader $headers = null, ?Body $body = null) {
    $this->method = $method;
    $this->url = $uri;
    /** @noinspection PhpUnhandledExceptionInspection - $elements is empty */
    $this->headers = $headers ?: new ArraySetHeader();
    $this->body = $body ?: new StringBodyFromString('');
  }

  public function uri(): URI {
    return $this->url;
  }

  public function method(): Method {
    return $this->method;
  }

  public function headers(): SetHeader {
    return $this->headers;
  }

  public function body(): Body {
    return $this->body;
  }
}
