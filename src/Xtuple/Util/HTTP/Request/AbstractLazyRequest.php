<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request;

use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;
use Xtuple\Util\HTTP\Request\Method\Method;
use Xtuple\Util\HTTP\Request\URI\URI;

abstract class AbstractLazyRequest
  implements Request {
  protected abstract function request(): Request;

  public final function uri(): URI {
    return $this->request()->uri();
  }

  public final function method(): Method {
    return $this->request()->method();
  }

  public final function headers(): SetHeader {
    return $this->request()->headers();
  }

  public final function body(): Body {
    return $this->request()->body();
  }
}
