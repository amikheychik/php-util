<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI;

/**
 * Class Server - for asterisk "*" for HTTP request URI.
 *
 * The asterisk "*" means that the request does not apply to a particular resource, but to the server itself, and is
 * only allowed when the method used does not necessarily apply to a resource
 *
 * @see https://www.w3.org/Protocols/rfc2616/rfc2616-sec5.html#sec5.1.2 - HTTP Request-URI: '*"
 */
final class Server
  implements URI {
  public function __toString(): string {
    return '*';
  }
}
